<?php

namespace App\Http\Controllers;

use App\Http\Frontend\DateFormats;
use App\Http\Frontend\Reservations\Options;
use App\Http\Models\Platen\PlatenRepository;
use App\Http\Models\Reservation\Reservation;
use App\Http\Models\Reservation\ReservationRepository;
use App\Http\Models\Reservation\TimeStingsFactory;
use App\Http\Models\ReservationStatus\ReservationStatus;
use App\Http\Models\ReservationStatus\ReservationStatusRepository;
use Carbon\Carbon;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * @var PlatenRepository
     */
    private $platenRepository;

    /**
     * @var ReservationRepository
     */
    private $reservationRepository;

    /**
     * @var ReservationStatusRepository
     */
    private $reservationStatusRepository;

    /**
     * @var TimeStingsFactory
     */
    private $timeStringsFactory;

    public function __construct(
        PlatenRepository            $platenRepository,
        ReservationRepository       $reservationRepository,
        ReservationStatusRepository $reservationStatusRepository,
        TimeStingsFactory           $timeStingsFactory
    )
    {
        $this->platenRepository            = $platenRepository;
        $this->reservationRepository       = $reservationRepository;
        $this->reservationStatusRepository = $reservationStatusRepository;
        $this->timeStringsFactory          = $timeStingsFactory;
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param string|null $message
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, string $message = null)
    {
        $filterKey = $request->input('filter-key', Options::ALL_KEY);

        if (ReservationStatus::isKeyValid($filterKey)) {
            $statusId     = $this->reservationStatusRepository->getIdByTitle(ReservationStatus::STATUSES_OPTIONS[$filterKey]);
            $reservations = $this->reservationRepository->findByStatusId($statusId);

            $viewParams = [
                'reservations'  => $reservations,
                'statusOptions' => Options::STATUSES_OPTIONS,
                'currentKey'    => $filterKey,
            ];

            if ($message) {
                $viewParams['message'] = $message;
            }
            return view('reservation.index', $viewParams);
        }

        throw new InvalidArgumentException('Неверный фильтр на брони');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $platens = $this->platenRepository->getAll();
        $defaultDate = Carbon::tomorrow()->toDateString();
        $bookedTimes = $this->reservationRepository->getBookedTimes((int) $platens->first()->id, $defaultDate, null);
        $times       = $this->timeStringsFactory->make($bookedTimes);

        return view('reservation.create', [
            'date'        => $defaultDate,
            'platens'     => $platens,
            'times'       => $times,
        ]);
    }

    public function getFreeTimes(Request $request)
    {
        $reservationId = null;
        if ($request['reservationId']) {
            $reservationId = (int) $request['reservationId'];
        }
        $bookedTimes = $this->reservationRepository->getBookedTimes((int) $request['platenId'], $request['date'], (int)$reservationId);
        $times       = $this->timeStringsFactory->make($bookedTimes);

        return $times;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return $this|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now         = Carbon::now();
        $requestData = $request->request->all();

        $validator = \Validator::make($requestData, [
            'platen-id'     => 'required|integer',
            'visit-date'    => "required|after:{$now}",
            'persons-count' => 'required|integer|max:65535',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $reservation                = new Reservation();
        $reservation->platen_id     = $request['platen-id'];
        $reservation->date          = $request['visit-date'];
        $reservation->time          = $request['visit-time'];
        $reservation->status_id     = $this->reservationStatusRepository->getIdByTitle(ReservationStatus::NEW);
        $reservation->count_persons = $request['persons-count'];
        $this->reservationRepository->save($reservation);

        return $this->index($request, 'Заказ успешно создан!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $reservation = $this->reservationRepository->find($id);

        return view('reservation.show')->with('reservation', $reservation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $platens     = $this->platenRepository->getAll();
        $statuses    = $this->reservationStatusRepository->getAll();
        $reservation = $this->reservationRepository->find($id);
        $bookedTimes = $this->reservationRepository->getBookedTimes((int) $reservation->platen_id, $reservation->date, (int) $reservation->id);
        $times       = $this->timeStringsFactory->make($bookedTimes);

        return view('reservation.edit', [
                'platens'     => $platens,
                'statuses'    => $statuses,
                'reservation' => $reservation,
                'times'       => $times,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $minDate = Carbon::now();
        $message = null;
        $requestData = $request->request->all();

        $validator = \Validator::make($requestData, [
            'platen-id'     => 'required|integer',
            'visit-date'    => "required|after:{$minDate}",
            'persons-count' => 'required|integer|max:65535',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $reservation                = $this->reservationRepository->find($id);
        $reservation->platen_id     = $request['platen-id'];
        $reservation->date          = $request['visit-date'];
        $reservation->time          = Carbon::parse($request['visit-time'])->toTimeString();
        $reservation->status_id     = $request['status-id'];
        $reservation->count_persons = $request['persons-count'];

        if($reservation->isDirty()) {
            $this->reservationRepository->save($reservation);
            $message = 'Заказ успешно изменен!';
        }

        return $this->index($request, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, Request $request)
    {
        $this->reservationRepository->delete($id);
    }
}

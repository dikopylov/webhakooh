<?php

namespace App\Http\Controllers;

use App\Http\Frontend\Reservations\Options;
use App\Http\Models\Platen\PlatenRepository;
use App\Http\Models\Reservation\Reservation;
use App\Http\Models\Reservation\ReservationRepository;
use App\Http\Models\ReservationStatus\ReservationStatus;
use App\Http\Models\ReservationStatus\ReservationStatusRepository;
use Carbon\Carbon;
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

    public function __construct(PlatenRepository $platenRepository, ReservationRepository $reservationRepository, ReservationStatusRepository $reservationStatusRepository)
    {
        $this->platenRepository            = $platenRepository;
        $this->reservationRepository       = $reservationRepository;
        $this->reservationStatusRepository = $reservationStatusRepository;
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = $this->reservationRepository->getAll();

        return view('reservation.index', [
            'reservations'  => $reservations,
            'statusOptions' => Options::STATUSES_OPTIONS,
            'currentKey'    => Options::ALL_KEY,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $platens = $this->platenRepository->getAll();

        return view('reservation.create')->with('platens', $platens);
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
        $minDate     = Carbon::now();
        $requestData = $request->request->all();

        $validator = \Validator::make($requestData, [
            'platen-id'     => 'required|integer',
            'visit-date'    => "required|after:{$minDate}",
            'persons-count' => 'required|integer|max:65535',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $reservation                = new Reservation();
        $reservation->platen_id     = $request['platen-id'];
        $reservation->date          = $request['visit-date'];
        $reservation->status_id     = $this->reservationStatusRepository->getIdByTitle(ReservationStatus::NEW);
        $reservation->count_persons = $request['persons-count'];
        $this->reservationRepository->save($reservation);

        return $this->index();

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

        return view('reservation.edit', [
                'platens'     => $platens,
                'statuses'    => $statuses,
                'reservation' => $reservation]
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
        $reservation->status_id     = $request['status-id'];
        $reservation->count_persons = $request['persons-count'];
        $this->reservationRepository->save($reservation);

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->reservationRepository->delete($id);

        return $this->index();
    }

    /**
     * @param Request $request
     *
     * @return $this|\Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $filterKey = $request->input('filterKey');

        if (isset(ReservationStatus::STATUSES_OPTIONS[$filterKey])) {
            $statusId     = $this->reservationStatusRepository->getIdByTitle(ReservationStatus::STATUSES_OPTIONS[$filterKey]);
            $reservations = $this->reservationRepository->findByStatusId($statusId);

            return view('reservation.index', [
                'reservations'  => $reservations,
                'statusOptions' => Options::STATUSES_OPTIONS,
                'currentKey'    => $filterKey,
            ]);
        }

        return $this->index();
    }
}

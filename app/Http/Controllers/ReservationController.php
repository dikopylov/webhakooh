<?php

namespace App\Http\Controllers;

use App\Connectors\TelegramBotConnector;
use App\Connectors\TelegramBotConnectorException;
use App\Events\ChangeReservationStatusEvent;
use App\Http\Frontend\DateFormats;
use App\Http\Frontend\Reservations\Options;
use App\Http\Models\Client\ClientRepository;
use App\Http\Models\Clients\Client;
use App\Http\Models\Platen\PlatenRepository;
use App\Http\Models\Reservation\Reservation;
use App\Http\Models\Reservation\ReservationRepository;
use App\Http\Models\Reservation\TimeStringsFactory;
use App\Http\Models\ReservationStatus\ReservationStatus;
use App\Http\Models\ReservationStatus\ReservationStatusRepository;
use App\Providers\EventServiceProvider;
use Carbon\Carbon;
use GuzzleHttp\Exception\TransferException;
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
     * @var TimeStringsFactory
     */
    private $timeStringsFactory;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var TelegramBotConnector
     */
    private $telegramBotConnector;

    public function __construct(
        PlatenRepository            $platenRepository,
        ReservationRepository       $reservationRepository,
        ReservationStatusRepository $reservationStatusRepository,
        ClientRepository            $clientRepository,
        TimeStringsFactory          $timeStingsFactory,
        TelegramBotConnector $telegramBotConnector
    )
    {
        $this->middleware(['auth']);
        $this->platenRepository            = $platenRepository;
        $this->reservationRepository       = $reservationRepository;
        $this->reservationStatusRepository = $reservationStatusRepository;
        $this->timeStringsFactory          = $timeStingsFactory;
        $this->clientRepository            = $clientRepository;
        $this->telegramBotConnector        = $telegramBotConnector;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filterKey = $request->input('currentKey', Options::NEW_KEY);

        if (ReservationStatus::isKeyValid($filterKey)) {
            $viewParams = [
                'currentKey'    => $filterKey,
            ];
            $viewParams['message'] = $request->input('message');
            $viewParams['alert']   = $request->input('alert');

            return view('reservation.index', $viewParams);
        }

        throw new InvalidArgumentException('Неверный фильтр на брони');
    }

    public function showAll(Request $request)
    {
        $filterKey = $request->input('currentKey', Options::NEW_KEY);

        if (ReservationStatus::isKeyValid($filterKey)) {
            $statusId     = $this->reservationStatusRepository->getIdByTitle(ReservationStatus::STATUSES_OPTIONS[$filterKey]);
            $reservations = $this->reservationRepository->findByStatusId($statusId);

            $viewParams = [
                'reservations'  => $reservations,
                'statusOptions' => Options::STATUSES_OPTIONS,
                'currentKey'    => $filterKey,
            ];

            if (isset($request['message'])) {
                $viewParams['message'] = $request['message'];
            }

            if (isset($request['alert'])) {
                $viewParams['alert']   = $request['alert'];
            }

            return view('reservation.main', $viewParams);
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
        $platens         = $this->platenRepository->getAll();
        $minDate         = Carbon::now()->toDateString();
        $defaultDate     = $minDate;
        $defaultPlatenId = $platens->first()->id;
        $bookedTimes     = $this->reservationRepository->getBookedTimes((int) $platens->first()->id, $defaultDate, null);
        $times           = $this->timeStringsFactory->make($bookedTimes, Carbon::parse($defaultDate));

        if ($times === []) {
            for ($dateTime = Carbon::parse($defaultDate);;$dateTime->addDay()) {
                foreach ($platens as $platen) {
                    $bookedTimes     = $this->reservationRepository->getBookedTimes($platen->id, $dateTime->toDateString(), null);
                    $times           = $this->timeStringsFactory->make($bookedTimes, $dateTime);

                    if ($times) {
                        $defaultPlatenId = $platen->id;
                        $defaultDate     = $dateTime->toDateString();
                        break 2;
                    }
                }
            }
        }

        return view('reservation.create', [
            'date'            => $defaultDate,
            'defaultPlatenId' => $defaultPlatenId,
            'platens'         => $platens,
            'times'           => $times,
            'minDate'         => $minDate,
        ]);
    }

    public function getFreeTimes(Request $request)
    {
        $reservationId = null;
        if ($request['reservationId']) {
            $reservationId = (int) $request['reservationId'];
        }
        $bookedTimes = $this->reservationRepository->getBookedTimes((int) $request['platenId'], $request['date'], (int)$reservationId);
        $times       = $this->timeStringsFactory->make($bookedTimes, Carbon::parse($request['date']));

        return array_values($times);
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
        $now         = Carbon::yesterday();
        $requestData = $request->request->all();

        $validator = \Validator::make($requestData, [
            'platen-id'     => 'required|integer',
            'visit-date'    => "required|after:{$now->toDateString()}",
            'persons-count' => 'required|integer|max:65535',
            'client-name'   => 'required',
            'client-phone'  => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $client = new Client();
        $client->name  = $request['client-name'];
        $client->phone = $request['client-phone'];
        $this->clientRepository->save($client);

        $reservation                = new Reservation();
        $reservation->platen_id     = $request['platen-id'];
        $reservation->date          = $request['visit-date'];
        $reservation->time          = $request['visit-time'];
        $reservation->status_id     = $this->reservationStatusRepository->getIdByTitle(ReservationStatus::CONFIRMED);
        $reservation->count_persons = $request['persons-count'];
        $reservation->client_id     = $client->id;
        $this->reservationRepository->save($reservation);

        return redirect()->route('reservation.index', [
            'message' => 'Заказ успешно создан!',
        ]);
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
        $times       = $this->timeStringsFactory->make($bookedTimes, Carbon::parse($reservation->date));

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
        $minDate = Carbon::yesterday();
        $message = null;
        $alert   = null;
        $requestData = $request->request->all();

        $validator = \Validator::make($requestData, [
            'platen-id'     => 'required|integer',
            'visit-date'    => "required|after:{$minDate->toDateString()}",
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
        $reservation->cancel_reason = $request['cancel-reason'] ?? null;

        if($reservation->isDirty()) {

            if (isset($reservation->getDirty()['status_id'])
                && $reservation->client->chat_id
                && $reservation->getDirty()['status_id'] != 1) {
                try {
                    $this->telegramBotConnector->notifyOnStatus($reservation);
                } catch (TelegramBotConnectorException $e) {
                    $alert = $e->getMessage();
                }
            }

            $this->reservationRepository->save($reservation);
            $message = 'Заказ успешно изменен!';
        }

        return redirect()->route('reservation.index', [
            'message' => $message,
            'alert' => $alert,
        ]);
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

<?php

namespace App\Http\Controllers\API;

use App\Http\Models\Client\ClientRepository;
use App\Http\Models\Clients\Client;
use App\Http\Models\Platen\PlatenService;
use App\Http\Models\Reservation\Reservation;
use App\Http\Models\Reservation\ReservationService;
use App\Http\Models\ReservationStatus\ReservationStatus;
use App\Http\Models\ReservationStatus\ReservationStatusRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    /**
     * @var ReservationService
     */
    private $reservationService;

    /**
     * @var ReservationStatusRepository
     */
    private $reservationStatusRepository;

    /**
     * @var PlatenService
     */
    private $platenService;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    public function __construct(
        ReservationService          $reservationService,
        ReservationStatusRepository $reservationStatusRepository,
        PlatenService               $platenService,
        ClientRepository            $clientRepository
    )
    {
        $this->reservationService          = $reservationService;
        $this->reservationStatusRepository = $reservationStatusRepository;
        $this->platenService               = $platenService;
        $this->clientRepository            = $clientRepository;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function isDateFree(Request $request)
    {
        return [
            'isDateFree' => $this->reservationService->isDateFree(Carbon::parse($request['date'])),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getFreeTimes(Request $request)
    {
        return  [
            'times' => $this->reservationService->getFreeTimes(Carbon::parse($request['date']))
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $visitDate    = $request['visitDate'];
        $visitTime    = $request['visitTime'];
        $personsCount = (int) $request['personsCount'];
        $platenId     = $request['platenId'] ?: $this->platenService->getFirstFreePlatenId(
            Carbon::parse($visitDate),
            Carbon::parse($visitTime),
            $personsCount
        );

        $chatId = (int) $request['chatId'];
        $client = $this->clientRepository->findByChatId($chatId) ?: new Client(['chat_id' => $chatId]);
        $client->name  = $request['name'];
        $client->phone = $request['phone'];
        $this->clientRepository->save($client);

        $reservation                = new Reservation();
        $reservation->platen_id     = $platenId;
        $reservation->date          = $visitDate;
        $reservation->time          = $visitTime;
        $reservation->count_persons = $personsCount;
        $reservation->status_id     = $this->reservationStatusRepository->getIdByTitle(ReservationStatus::NEW);
        $reservation->client_id     = $client->id;
        $reservation->comment       = $request['comment'];

        return [
            'savedId' => $this->reservationService->save($reservation)
        ];
    }
}

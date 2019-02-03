<?php

namespace App\Connectors;


use App\Http\Models\Reservation\Reservation;
use App\Http\Models\ReservationStatus\ReservationStatus;
use GuzzleHttp\Client as Guzzle;

class TelegramBotConnector
{
    /**
     * @var Guzzle
     */
    private $apiClient;

    public function __construct(Guzzle $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function processReservation(Reservation $reservation)
    {
        $this->apiClient->post('process-reservation',
            [
                'query' => [
                    'id'           => $reservation->id,
                    'chatId'       => $reservation->client()->id,
                    'clientName'   => $reservation->client()->name,
                    'date'         => $reservation->date,
                    'time'         => $reservation->time,
                    'platenId'     => $reservation->platen()->id,
                    'countPersons' => $reservation->count_persons,
                    'isConfirm'    => $reservation->reservationStatus()->isConfirm(),
                    'cancelReason' => $reservation->cancel_reason,
                ]
            ]
        );
    }
}
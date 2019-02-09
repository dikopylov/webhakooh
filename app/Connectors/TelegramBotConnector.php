<?php

namespace App\Connectors;


use App\Http\Models\Reservation\Reservation;
use App\Http\Models\ReservationStatus\ReservationStatus;
use GuzzleHttp\Client as Guzzle;
use Mockery\Exception;

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

    public function notifyOnStatus(Reservation $reservation)
    {
        try {
            $response = $this->apiClient->post('notify-on-status',
                [
                    'query' => [
                        'id' => $reservation->id,
                        'chatId' => $reservation->client->chat_id,
                        'clientName' => $reservation->client->name,
                        'date' => $reservation->date,
                        'time' => $reservation->time,
                        'platenId' => $reservation->platen->id,
                        'countPersons' => $reservation->count_persons,
                        'isConfirm' => $reservation->reservationStatus->isConfirm(),
                        'cancelReason' => $reservation->cancel_reason,
                    ]
                ]
            );

            $result = json_decode($response->getBody()->getContents());
        } catch (Exception $e) {
        }

        if (!$result->success) {
            throw new TelegramBotConnectorException('Внимание! Информация о смене статуса брони <b>НЕ</b> отправлена клиенту в чат с ботом!');
        }
    }
}
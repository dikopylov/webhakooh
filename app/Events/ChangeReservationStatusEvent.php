<?php

namespace App\Events;


use App\Http\Models\Reservation\Reservation;

class ChangeReservationStatusEvent
{
    /**
     * @var Reservation
     */
    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }
}
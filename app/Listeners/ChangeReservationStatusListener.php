<?php

namespace App\Listeners;

use App\Events\ChangeReservationStatusEvent;

class ChangeReservationStatusListener
{
    public function handle(ChangeReservationStatusEvent $event)
    {
        dd($event->reservation);
    }
}
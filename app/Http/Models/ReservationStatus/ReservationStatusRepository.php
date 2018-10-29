<?php

namespace App\Http\Models\ReservationStatus;


class ReservationStatusRepository
{
    /**
     * @param string $title
     * @see ReservationStatus
     * @return int
     */
    public function getIdByTitle(string $title) : int
    {
        return ReservationStatus::where('title', $title)->first()['id'];
    }

    public function getAll()
    {
        return ReservationStatus::all();
    }
}
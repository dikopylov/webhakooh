<?php

namespace App\Http\Models\ReservationStatus;

use \Illuminate\Database\Eloquent\Collection;

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

    /**
     * @return Collection
     */
    public function getAll()
    {
        return ReservationStatus::all();
    }
}
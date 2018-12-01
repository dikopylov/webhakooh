<?php

namespace App\Http\Models\ReservationStatus;

use \Illuminate\Database\Eloquent\Collection;

class ReservationStatusRepository
{
    /**
     * @param string $title
     * @see ReservationStatus::STATUSES_OPTIONS
     *
     * @return int
     */
    public function getIdByTitle(string $title) : ?int
    {
        if (ReservationStatus::isAll($title)) {
            return null;
        }

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
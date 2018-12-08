<?php

namespace App\Http\Models\Reservation;

use App\Http\Frontend\Reservations\ReservationPagination;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository
{
    /**
     * @param Reservation $reservation
     * @return bool
     */
    public function save(Reservation $reservation)
    {
        return $reservation->save();
    }

    /**
     * @param int $id
     * @return Reservation
     */
    public function find(int $id) : Reservation
    {
        return Reservation::find($id);
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return Reservation::destroy($id);
    }

    /**
     * @param int $statusId
     *
     * @return Collection
     */
    public function findByStatusId($statusId = null)
    {
        if ($statusId) {
            $builder = Reservation::where('status_id', $statusId)->orderByDesc('created_at');
        } else {
            $builder = Reservation::orderByDesc('created_at');
        }

        return $builder->paginate(ReservationPagination::$maxItemsOnPage);
    }
}
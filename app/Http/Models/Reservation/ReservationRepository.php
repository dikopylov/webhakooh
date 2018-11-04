<?php


namespace App\Http\Models\Reservation;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository
{

    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return Reservation::all()->sortByDesc('created_at');
    }

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
     * @return Collection
     */
    public function showNew() : Collection
    {
        return Reservation::all()->where('status_id', 1)->sortByDesc('created_at');
    }

    public function showConfirm() : Collection
    {
        return Reservation::all()->where('status_id', 2)->sortByDesc('created_at');
    }


}
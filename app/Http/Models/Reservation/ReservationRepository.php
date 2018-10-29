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
        return Reservation::all();
    }

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

    public function delete($id)
    {
        return Reservation::destroy($id);
    }
}
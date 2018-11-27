<?php


namespace App\Http\Models\Reservation;


use Illuminate\Database\Eloquent\Collection;

class ReservationRepository
{

    /**
     * @return Collection
     */
    public function getAll()
    {
        return Reservation::orderByDesc('created_at')->paginate(4);
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
     * @param int $statusId
     *
     * @return Collection
     */
    public function findByStatusId(int $statusId)
    {
        return Reservation::where('status_id', $statusId)->orderByDesc('created_at')->paginate(4);
    }
}
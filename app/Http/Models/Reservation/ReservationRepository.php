<?php


namespace App\Http\Models\Reservation;


use Illuminate\Database\Eloquent\Collection;

class ReservationRepository
{

    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return Reservation::where('is_delete', false)->get();
    }

    public function create(array $data)
    {
        return Reservation::create([
            'platen_id' => $data['platen-id'],
            'date' => $data['date'],
            'status_id' => $data['status-id'],
            'count_persons' => $data['status-id']
        ]);
    }

    /**
     * @param int $id
     * @return Reservation
     */
    public function find(int $id) : Reservation
    {
        return Reservation::find($id);
    }


    public function update($id, array $data)
    {
        $reservation = $this->find($id);
        dd($reservation);
    }

    public function delete($id)
    {
        $reservation = $this->find($id);
        $reservation->is_delete = true;
        $reservation->save();
    }
}
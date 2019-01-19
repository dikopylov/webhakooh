<?php

namespace App\Http\Models\Reservation;

use App\Http\Frontend\Reservations\ReservationPagination;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository
{
    private $table = 'reservations';

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
     * @param int $platenId
     * @param string $date
     * @param int|null $reservationId
     * @return string[]
     */
    public function getBookedTimes(int $platenId, string $date, ?int $reservationId): array
    {
        $whereConditions = [
            ['date', '=', $date],
            ['platen_id', '=', $platenId],
        ];

        if ($reservationId) {
            $whereConditions[] = ['id', '!=', $reservationId];
        }

        $times = [];
        $reservations = \DB::table($this->table)->where($whereConditions)->get(['time']);
        foreach ($reservations as $reservation) {
            $times[] = $reservation->time;
        }

        return $times;
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
     * @param int $platenId
     * @return mixed
     */
    public function deleteByPlatenId(int $platenId)
    {
        return Reservation::where('platen_id', $platenId)->delete();
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

    /**
     * @param string $date
     * @param string $time
     * @param int $platenId
     * @return bool
     */
    public function isFreePlaten(string $date, string $time, int $platenId) :bool
    {
        $reservations = \DB::table($this->table)->where([
            'platen_id' => $platenId,
            'time'      => $time,
            'date'      => $date
        ])->get();

        return $reservations->isEmpty();
    }
}
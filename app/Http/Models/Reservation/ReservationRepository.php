<?php

namespace App\Http\Models\Reservation;

use App\Http\Frontend\Reservations\ReservationPagination;
use Carbon\Carbon;
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
     * @param Reservation $reservation
     * @return string[]
     */
    public function findBookedTimesByReservation(Reservation $reservation): array
    {
        return $this->getBookedTimes((int) $reservation->platen_id, $reservation->date, (int) $reservation->id);
    }

    /**
     * @param int $platenId
     * @param string $date
     * @return string[]
     */
    public function findBookedTimesByPlatenIdAndDate(int $platenId, string $date): array
    {
        return $this->getBookedTimes($platenId, $date, null);
    }

    /**
     * @param int $platenId
     * @param string $date
     * @param int|null $reservationId
     * @return string[]
     */
    private function getBookedTimes(int $platenId, string $date, ?int $reservationId): array
    {
        $whereConditions = [
            ['date', '=', $date],
            ['platen_id', '=', $platenId],
        ];

        if ($reservationId) {
            $whereConditions[] = ['id', '!=', $reservationId];
        }

        return \DB::table($this->table)->where($whereConditions)->get(['time'])->toArray();
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
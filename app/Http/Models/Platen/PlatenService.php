<?php

namespace App\Http\Models\Platen;


use App\Http\Models\Reservation\ReservationRepository;
use Carbon\Carbon;

class PlatenService
{
    /**
     * @var PlatenRepository
     */
    private $platenRepository;

    /**
     * @var ReservationRepository
     */
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepository, PlatenRepository $platenRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->platenRepository      = $platenRepository;
    }

    /**
     * @param Carbon $date
     * @param Carbon $time
     * @param int $personsCount
     * @return Platen[]
     */
    public function getFreePlatens(Carbon $date, Carbon $time, int $personsCount) :array
    {
        $platens         = $this->platenRepository->getByCapacity($personsCount);
        $freePlatens     = [];

        foreach ($platens as $platen) {
            if ($this->reservationRepository->isFreePlaten($date->toDateString(), $time->toTimeString(), $platen)) {
                $freePlatens[$platen->id] = $platen;
            }
        }

        return $freePlatens;
    }

    /**
     * @param Carbon $date
     * @param Carbon $time
     * @param int $personsCount
     * @return int
     */
    public function getFirstFreePlatenId(Carbon $date, Carbon $time, int $personsCount): int
    {
        $platen = array_shift($this->getFreePlatens($date, $time, $personsCount));
        return $platen->id;
    }
}
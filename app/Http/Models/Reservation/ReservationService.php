<?php

namespace App\Http\Models\Reservation;


use App\Http\Models\Platen\Platen;
use App\Http\Models\Platen\PlatenRepository;
use Carbon\Carbon;

class ReservationService
{
    /**
     * @var ReservationRepository
     */
    private $reservationRepository;

    /**
     * @var TimeStringsFactory
     */
    private $timeStringsFactory;

    /**
     * @var PlatenRepository
     */
    private $platenRepository;

    public function __construct(ReservationRepository $reservationRepository, TimeStringsFactory $timeStringsFactory, PlatenRepository $platenRepository)
    {
        $this->reservationRepository = $reservationRepository;
        $this->timeStringsFactory    = $timeStringsFactory;
        $this->platenRepository      = $platenRepository;
    }

    /**
     * @param Carbon $date
     * @return bool
     */
    public function isDateFree(Carbon $date) :bool
    {
        $platens         = $this->platenRepository->getAll();
        $isFree = false;

        foreach ($platens as $platen) {
            $bookedTimes     = $this->reservationRepository->getBookedTimes($platen->id, $date->toDateString(), null);
            $times           = $this->timeStringsFactory->make($bookedTimes);

            if ($times) {
                $isFree = true;
                break;
            }
        }

        return $isFree;
    }

    /**
     * @param Carbon $date
     * @return string[]
     */
    public function getFreeTimes(Carbon $date) :array
    {
        $platens         = $this->platenRepository->getAll();
        $times = [];

        foreach ($platens as $platen) {
            $bookedTimes     = $this->reservationRepository->getBookedTimes($platen->id, $date->toDateString(), null);
            $times           = $times + $this->timeStringsFactory->make($bookedTimes);
        }

        return $times;
    }
}
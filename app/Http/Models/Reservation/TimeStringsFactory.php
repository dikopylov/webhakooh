<?php

namespace App\Http\Models\Reservation;

use App\Http\Frontend\DateFormats;
use Carbon\Carbon;

class TimeStringsFactory
{
    /**
     * @param string[] $bookedTimes
     * @param Carbon $bookDate
     * @return array
     */
    public function make(array $bookedTimes, Carbon $bookDate): array
    {
        $bookedTimesDateTime = [];
        foreach ($bookedTimes as $bookedTime) {
            $bookedTimesDateTime[] = Carbon::parse($bookedTime);
        }

        $times   = [];
        if ($bookDate->toDateString() === Carbon::now()->toDateString()) {
            $currentMinute = (int) Carbon::now()->format('i');
            $format = $currentMinute >= 30 ? 'H:00' : 'H:30';
            $start = Carbon::parse(Carbon::now()->addMinute(30)->format($format));
        } else {
            $start   = Carbon::parse('00:00');
        }
        $end     = Carbon::parse('23:30');
        $current = $start;

        while ($current <= $end) {
            if (!in_array($current, $bookedTimesDateTime) ) {
                $time = $current->format(DateFormats::SELECT_TIME_FORMAT);
                $times[$time] = $time;
            }
            $current->addMinute(30);
        }

        return $times;
    }
}
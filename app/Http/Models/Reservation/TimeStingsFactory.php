<?php

namespace App\Http\Models\Reservation;

use App\Http\Frontend\DateFormats;
use Carbon\Carbon;

class TimeStingsFactory
{
    /**
     * @param string[] $bookedTimes
     * @return array
     */
    public function make(array $bookedTimes): array
    {
        $bookedTimesDateTime = [];
        foreach ($bookedTimes as $bookedTime) {
            $bookedTimesDateTime[] = Carbon::parse($bookedTime);
        }

        $times   = [];
        $start   = Carbon::parse('00:00');
        $end     = Carbon::parse('23:30');
        $current = $start;

        while ($current <= $end) {
            if (!in_array($current, $bookedTimesDateTime)) {
                $times[] = $current->format(DateFormats::SELECT_TIME_FORMAT);
            }
            $current->addMinute(30);
        }

        return $times;
    }
}
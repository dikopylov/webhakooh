<?php

namespace App\Http\Models\ReservationStatus;

use App\Http\Frontend\Reservations\Options;
use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    public const ALL       = 'все';
    public const NEW       = 'новый';
    public const CONFIRMED = 'подтвержден';
    public const REJECTED  = 'отклонен';

    public const STATUSES_OPTIONS = [
        Options::ALL_KEY       => self::ALL,
        Options::NEW_KEY       => self::NEW,
        Options::CONFIRMED_KEY => self::CONFIRMED,
        Options::REJECTED_KEY  => self::REJECTED,
    ];

    public static function isAll(string $status): bool
    {
        return $status === self::ALL;
    }

}

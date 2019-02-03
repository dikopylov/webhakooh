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

    public const REJECTED_ID = 3;

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

    public static function isKeyValid(string $key)
    {
        return array_key_exists($key, self::STATUSES_OPTIONS);
    }

    /**
     * @return bool
     */
    public function isConfirm(): bool
    {
        return $this->title === self::CONFIRMED;
    }
}

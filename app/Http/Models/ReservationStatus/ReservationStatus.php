<?php

namespace App\Http\Models\ReservationStatus;

use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    public const NEW       = 'новый';
    public const CONFIRMED = 'подтвержден';
    public const REJECTED  = 'отклонен';

    public const STATUSES = [
        'new'       => self::NEW,
        'confirmed' => self::CONFIRMED,
        'rejected'  => self::REJECTED,
    ];
}

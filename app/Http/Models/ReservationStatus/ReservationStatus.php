<?php

namespace App\Http\Models\ReservationStatus;

use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    public const NEW = 'Новый';
    public const CONFIRMED = 'Подтвержден';
    public const REJECTED = 'Отклонен';
}

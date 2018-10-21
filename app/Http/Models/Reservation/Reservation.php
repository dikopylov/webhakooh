<?php

namespace App\Http\Models\Reservation;

use App\Http\Models\Platen\Platen;
use App\Http\Models\ReservationStatus\ReservationStatus;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = array(
        'platen_id', 'date', 'start_hour', 'client_id', 'count_persons'
    );

    public function platen()
    {
        $this->hasOne(Platen::class);
    }

    public function reservationStatus()
    {
        $this->hasOne(ReservationStatus::class);
    }
}

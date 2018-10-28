<?php

namespace App\Http\Models\Reservation;

use App\Http\Models\Platen\Platen;
use App\Http\Models\ReservationStatus\ReservationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Reservation extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array(
        'platen_id', 'date', 'status_id', 'count_persons'
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

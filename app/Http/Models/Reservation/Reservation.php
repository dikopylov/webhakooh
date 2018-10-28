<?php

namespace App\Http\Models\Reservation;

use App\Http\Models\Clients\Client;
use App\Http\Models\Notifier;
use App\Http\Models\Platen\Platen;
use App\Http\Models\ReservationStatus\ReservationStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Reservation extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];


    public function platen()
    {
        return $this->hasOne(Platen::class, 'id', 'platen_id');
    }

    public function reservationStatus()
    {
        return $this->hasOne(ReservationStatus::class, 'id', 'status_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function notifier()
    {
        return $this->hasOne(Notifier::class, 'id', 'notify_id');
    }
}

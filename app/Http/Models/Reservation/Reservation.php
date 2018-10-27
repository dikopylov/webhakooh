<?php

namespace App\Http\Models\Reservation;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Reservation extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];
}

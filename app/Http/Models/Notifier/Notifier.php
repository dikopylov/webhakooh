<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Notifier extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];
}

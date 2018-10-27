<?php

namespace App\Http\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];
}

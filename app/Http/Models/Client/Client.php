<?php

namespace App\Http\Models\Clients;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model
{
    use LogsActivity, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'phone',
        'chat_id',

    ];

    protected $dates = ['deleted_at'];
}

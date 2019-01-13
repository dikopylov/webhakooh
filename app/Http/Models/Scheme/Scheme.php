<?php

namespace App\Http\Models\Scheme;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Scheme extends Model
{
    use LogsActivity, SoftDeletes, CausesActivity;

    protected $fillable = [
        'id',
        'base64',
    ];

    protected $dates = ['deleted_at'];

    protected static $logName = 'Схема столов';

}

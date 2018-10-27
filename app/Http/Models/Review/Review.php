<?php

namespace App\Http\Models\Review;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Review extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];
}

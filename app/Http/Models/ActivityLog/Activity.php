<?php


namespace App\Http\Models\ActivityLog;


use App\Http\Models\User\User;

class Activity extends \Spatie\Activitylog\Models\Activity
{
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
<?php


namespace App\Http\Models\ActivityLog;


class Activity extends \Spatie\Activitylog\Models\Activity
{
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User\User', 'id');
    }
}
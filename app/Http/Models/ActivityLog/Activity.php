<?php


namespace App\Http\Models\ActivityLog;


use App\Http\Models\User\User;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Activity extends \Spatie\Activitylog\Models\Activity
{
    use CausesActivity, LogsActivity;

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
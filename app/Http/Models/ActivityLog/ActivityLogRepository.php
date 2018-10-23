<?php


namespace App\Http\Models\ActivityLog;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ActivityLogRepository extends Model
{
    use LogsActivity;

    public function getAll()
    {
        return Activity::all();
    }

    public function last()
    {
        return Activity::all()->last();
    }

}
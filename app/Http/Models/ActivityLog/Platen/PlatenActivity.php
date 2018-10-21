<?php


namespace App\Http\Models\ActivityLog\Platen;
use App\Http\Models\ActivityLog\RuEvent;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PlatenActivity extends Model
{
    use LogsActivity;

    protected $fillable = ['title', 'capacity', 'is_delete'];

    protected static $logName = 'platens';

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = RuEvent::ruEvent[$eventName];
        return "Cтол был {$eventName}";
    }
}
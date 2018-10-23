<?php

namespace App\Http\Models\Platen;

use App\Http\Models\Translate\RuEvent;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Platen extends Model
{
    use LogsActivity;

    protected $fillable = array(
        'title', 'capacity', 'is_delete'
    );

    protected static $logName = 'стол';

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = RuEvent::ruEvent[$eventName];
        return "Cтол {$eventName}";
    }



}

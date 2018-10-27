<?php

namespace App\Http\Models\Platen;

use App\Http\Models\TranslateActivityLog\RuEvent;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Platen extends Model
{
    use LogsActivity;

    protected $fillable = array(
        'title', 'capacity', 'is_delete'
    );

    protected static $logAttributes = [
        'title',
        'capacity',
        'is_delete'
    ];

    protected static $logName = 'Столы';

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = RuEvent::ruEvent[$eventName];
        return "{$eventName} :causer.login";
    }



}

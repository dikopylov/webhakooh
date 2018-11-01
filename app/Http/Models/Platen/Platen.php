<?php

namespace App\Http\Models\Platen;

use App\Http\Models\TranslateActivityLog\EventsTranslator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Platen extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = array(
        'title', 'capacity'
    );

    protected static $logAttributes = [
        'title',
        'capacity',
    ];


    protected static $logName = 'Столы';

    /**
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = EventsTranslator::ru[$eventName];
        return "{$eventName} :causer.login";
    }



}

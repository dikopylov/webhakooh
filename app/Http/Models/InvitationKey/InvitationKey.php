<?php

namespace App\Http\Models\InvitationKey;

use App\Http\Models\TranslateActivityLog\EventsTranslator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class InvitationKey extends Model
{
    use LogsActivity, SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * @var string
     */
    protected $table = 'invitation_keys';

    protected $fillable = [
        'key', 'author_id'
    ];

    protected static $logAttributes = [
        'key', 'author_id'
    ];

    protected static $logName = 'Ключи приглашения';

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

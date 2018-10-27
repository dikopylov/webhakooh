<?php

namespace App\Http\Models\InvitationKey;

use App\Http\Models\TranslateActivityLog\RuEvent;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class InvitationKey extends Model
{
    use LogsActivity;
    /**
     * @var string
     */
    protected $table = 'invitation_keys';

    protected $fillable = [
        'key', 'author_id', 'is_delete', 'is_used'
    ];

    protected static $logAttributes = [
        'key', 'author_id', 'is_delete', 'is_used'
    ];

    protected static $logName = 'Ключи приглашения';

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = RuEvent::ruEvent[$eventName];
        return "{$eventName} :causer.login";
    }
}

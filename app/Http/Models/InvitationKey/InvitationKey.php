<?php

namespace App\Http\Models\InvitationKey;

use App\Http\Models\Translate\RuEvent;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class InvitationKey extends Model
{
    use LogsActivity;
    /**
     * @var string
     */
    protected $table = 'invitation_keys';

    protected $fillable = array(
        'key', 'author_id', 'is_delete', 'is_used'
    );

    protected static $logName = 'ключ';

    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = RuEvent::ruEvent[$eventName];
        return "Ключ приглашения {$eventName}";
    }
}

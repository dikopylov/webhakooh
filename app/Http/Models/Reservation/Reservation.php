<?php

namespace App\Http\Models\Reservation;

use App\Http\Models\Clients\Client;
use App\Http\Models\Notifier;
use App\Http\Models\Platen\Platen;
use App\Http\Models\ReservationStatus\ReservationStatus;
use App\Http\Models\TranslateActivityLog\EventsTranslator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Reservation extends Model
{
    use LogsActivity, SoftDeletes, CausesActivity;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'platen_id', 'date', 'status_id',
        'client_id', 'count_persons', 'comment', 'notify_id',
    ];

    /**
     * @var array
     */
    protected static $logAttributes = [
        'platen_id', 'date', 'status_id',
        'client_id', 'count_persons', 'comment', 'notify_id',
    ];

    /**
     * @var string
     */
    protected static $logName = 'Бронирование';

    /**
     * @param string $eventName
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = EventsTranslator::ru[$eventName];
        return "{$eventName} :causer.login";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function platen()
    {
        return $this->hasOne(Platen::class, 'id', 'platen_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function reservationStatus()
    {
        return $this->hasOne(ReservationStatus::class, 'id', 'status_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function notifier()
    {
        return $this->hasOne(Notifier::class, 'id', 'notify_id');
    }
}

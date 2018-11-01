<?php

namespace App\Http\Models\User;

use App\Http\Models\ActivityLog\Activity;
use App\Http\Models\TranslateActivityLog\RuEvent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasRoles, LogsActivity, CausesActivity;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'password', 'first_name', 'patronymic',
        'second_name', 'email', 'phone', 'invitation_key_id'
    ];

    protected static $logAttributes = [
        'login', 'password', 'first_name', 'patronymic',
        'second_name', 'email', 'phone', 'invitation_key_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static $logName = 'Пользователи';

    /**
     * @param string $eventName
     *
     * @return string
     */
    public function getDescriptionForEvent(string $eventName): string
    {
        $eventName = RuEvent::ruEvent[$eventName];
        return "{$eventName} :causer.login";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class, 'causer_id');
    }
}

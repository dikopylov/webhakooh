<?php

namespace App\Http\Models\Review;

use App\Http\Models\Clients\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Review extends Model
{
    use LogsActivity, SoftDeletes, CausesActivity;

    protected $fillable = [
        'id',
        'client_id',
        'content',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @var string
     */
    protected static $logName = 'Отзывы';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}

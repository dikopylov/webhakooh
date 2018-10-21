<?php


namespace App\Http\Models\ActivityLog;


abstract class RuEvent
{
    const ruEvent = [
        'created' => 'создан',
        'updated' => 'обновлен',
        'deleted' => 'удален'
    ];
}
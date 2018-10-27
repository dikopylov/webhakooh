<?php


namespace App\Http\Models\TranslateActivityLog;


abstract class RuEvent
{
    const ruEvent = [
        'created' => 'Создан',
        'updated' => 'Обновлен',
        'deleted' => 'Удален'
    ];
}
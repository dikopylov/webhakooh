<?php


namespace App\Http\Models\TranslateActivityLog;


abstract class EventsTranslator
{
    const ru = [
        'created' => 'Создан',
        'updated' => 'Обновлен',
        'deleted' => 'Удален'
    ];
}
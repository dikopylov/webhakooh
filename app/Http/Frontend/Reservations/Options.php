<?php


namespace App\Http\Frontend\Reservations;

use App\Http\Enum;

abstract class Options extends Enum
{
    public const STATUSES_OPTIONS = [
        'all'       => 'Все брони',
        'new'       => 'Новые брони',
        'confirmed' => 'Подтвержденные брони',
        'rejected'  => 'Отклоненные брони',
    ];

    public const ALL_KEY       = 'all';
    public const NEW_KEY       = 'new';
    public const CONFIRMED_KEY = 'confirmed';
    public const REJECTED_KEY  = 'rejected';
}
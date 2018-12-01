<?php


namespace App\Http\Frontend\Reservations;

use App\Http\Enum;

abstract class Options extends Enum
{
    public const STATUSES_OPTIONS = [
        self::ALL_KEY       => 'Все брони',
        self::NEW_KEY       => 'Новые брони',
        self::CONFIRMED_KEY => 'Подтвержденные брони',
        self::REJECTED_KEY  => 'Отклоненные брони',
    ];

    public const ALL_KEY       = 'all';
    public const NEW_KEY       = 'new';
    public const CONFIRMED_KEY = 'confirmed';
    public const REJECTED_KEY  = 'rejected';
}
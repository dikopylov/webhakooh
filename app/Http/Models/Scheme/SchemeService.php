<?php

namespace App\Http\Models\Scheme;


class SchemeService
{
    /**
     * @var Scheme
     */
    private static $scheme;

    /**
     * @return Scheme
     */
    public static function getScheme() : Scheme
    {
        if (self::$scheme === null) {
            self::$scheme = new Scheme();
            $path = env('PLATEN_SCHEME_PATH');
            $type = pathinfo(__DIR__ . '/../../../../' .$path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            self::$scheme->base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        return self::$scheme;
    }
}
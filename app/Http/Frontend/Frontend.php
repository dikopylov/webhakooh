<?php


namespace App\Http\Frontend;


use App\Http\Frontend\Image\ImageService;

class Frontend
{
    /**
     * @var
     */
    private static $imageService;

    /**
     * @return ImageService
     */
    public static function ImageService(): ImageService
    {
        if (self::$imageService === null) {
            self::$imageService = new ImageService();
        }

        return self::$imageService;
    }
}
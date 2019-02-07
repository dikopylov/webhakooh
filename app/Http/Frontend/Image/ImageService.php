<?php


namespace App\Http\Frontend\Image;


class ImageService
{
    const FILE_NAME = 'img/platen-scheme.png';
    const IMAGE_DIR = __DIR__ . '/../../../../public/';

    /**
     * @param string      $base64
     * @param string|null $fileName
     *
     * @return string
     */
    public function convertBase64ToImage(string $base64, string $fileName = null): string
    {
        if ($fileName) {
            $imageLink  = self::IMAGE_DIR . $fileName;
            $outputPath = "/{$fileName}";
        }
        else {
            $imageLink  = self::IMAGE_DIR . self::FILE_NAME;
            $outputPath = '/' . self::FILE_NAME;
        }

        $file = fopen($imageLink, "wb");

        $data = explode(',', $base64);

        if (count($data) > 1) {
            fwrite($file, base64_decode($data[1]));
        }
        else {
            fwrite($file, base64_decode($data[0]));
        }

        fclose($file);

        return $outputPath;
    }
}
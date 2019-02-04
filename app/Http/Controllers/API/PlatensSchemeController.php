<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\Scheme\PlatensSchemeRepository;
use App\Http\Resources\PlatensSchemeResource;

class PlatensSchemeController extends Controller
{
    /**
     * @var PlatensSchemeRepository
     */
    private $schemeRepository;

    public function __construct(PlatensSchemeRepository $schemeRepository)
    {
        $this->schemeRepository = $schemeRepository;
    }

    /**
     * @return array
     */
    public function show()
    {
        $platenScheme      = new PlatensSchemeResource($this->schemeRepository->get());
        $platenScheme->url = $this->convertBase64ToImage($platenScheme->base64);

        return ['platenScheme' => $platenScheme];
    }

    /**
     * @param $base64
     *
     * @return string
     */
    private function convertBase64ToImage($base64): string
    {
        $imageLink = __DIR__ . '/../../resources/images/platen-scheme.png';
        $file      = fopen($imageLink, "wb");

        $data = explode(',', $base64);

        fwrite($file, base64_decode($data[1]));
        fclose($file);

        return $imageLink;
    }
}

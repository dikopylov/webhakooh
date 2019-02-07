<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Frontend\Frontend;
use App\Http\Models\Scheme\PlatensSchemeRepository;

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
        $platenScheme      = $this->schemeRepository->get();
        $imagePath         = Frontend::ImageService()->convertBase64ToImage($platenScheme->base64);
        $platenScheme->url = url($imagePath);

        return ['platenScheme' => [
            'id'   => $platenScheme->id,
            'name' => $platenScheme->name,
            'url'  => $platenScheme->url,
        ]];
    }
}

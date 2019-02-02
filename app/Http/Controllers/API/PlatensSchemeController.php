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
        return ['platenScheme' => new PlatensSchemeResource($this->schemeRepository->get())];
    }
}

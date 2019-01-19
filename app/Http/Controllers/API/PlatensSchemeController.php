<?php

namespace App\Http\Controllers\API;

use App\Http\Models\Scheme\PlatensSchemeRepository;
use App\Http\Resources\PlatensSchemeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * @return PlatensSchemeResource
     */
    public function show()
    {
        return new PlatensSchemeResource($this->schemeRepository->get());
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Models\Scheme\SchemeRepository;
use App\Http\Resources\Scheme as SchemeResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchemeController extends Controller
{
    private $schemeRepository;

    public function __construct(SchemeRepository $schemeRepository)
    {
        $this->schemeRepository = $schemeRepository;
    }

    /**
     * @return SchemeResource
     */
    public function show()
    {
        return new SchemeResource($this->schemeRepository->get());
    }
}

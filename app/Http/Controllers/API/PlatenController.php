<?php

namespace App\Http\Controllers\API;

use App\Http\Models\Platen\PlatenService;
use App\Http\Resources\PlatenResourceCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatenController extends Controller
{
    /**
     * @var PlatenService
     */
    private $platenService;

    public function __construct(PlatenService $platenService)
    {
        $this->platenService = $platenService;
    }

    public function getFreePlatens(Request $request)
    {
        return new PlatenResourceCollection($this->platenService->getFreePlatens(
            Carbon::parse($request['date']),
            Carbon::parse($request['time']),
            (int) $request['personsCount']
        ));
    }
}

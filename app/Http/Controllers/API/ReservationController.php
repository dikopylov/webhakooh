<?php

namespace App\Http\Controllers\API;

use App\Http\Models\Reservation\ReservationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    /**
     * @var ReservationService
     */
    private $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function isDateFree(Request $request)
    {
        return [
            'isDateFree' => $this->reservationService->isDateFree(Carbon::parse($request['date'])),
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getFreeTimes(Request $request)
    {
        return $this->reservationService->getFreeTimes(Carbon::parse($request['date']));
    }
}

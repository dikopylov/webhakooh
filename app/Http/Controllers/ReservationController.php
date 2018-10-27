<?php

namespace App\Http\Controllers;

use App\Http\Models\Platen\PlatenRepository;
use App\Http\Models\Reservation\ReservationRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * @var PlatenRepository
     */
    private $platenRepository;

    /**
     * @var ReservationRepository
     */
    private $reservationRepository;

    public function __construct(PlatenRepository $platenRepository, ReservationRepository $reservationRepository) {
        $this->platenRepository      = $platenRepository;
        $this->reservationRepository = $reservationRepository;
        $this->middleware(['auth' ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = $this->reservationRepository->getAll();
        return view('reservation.index')->with('reservations', $reservations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $platens = $this->platenRepository->getAll();
        return view('reservation.create', [
            'platens' => $platens,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $minDate = Carbon::now()->toDateString();
        $this->validate($request, [
            'platen-id' => 'required|integer',
            'visit-date' => "required|min:{$minDate}",
            'persons-count' => 'required|max:65535'
        ]);
        dd(34);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

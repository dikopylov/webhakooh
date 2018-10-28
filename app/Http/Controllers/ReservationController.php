<?php

namespace App\Http\Controllers;

use App\Http\Models\Platen\PlatenRepository;
use App\Http\Models\Reservation\Reservation;
use App\Http\Models\Reservation\ReservationRepository;
use App\Http\Models\ReservationStatus\ReservationStatus;
use App\Http\Models\ReservationStatus\ReservationStatusRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;

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

    /**
     * @var ReservationStatusRepository
     */
    private $reservationStatusRepository;

    public function __construct(PlatenRepository $platenRepository, ReservationRepository $reservationRepository, ReservationStatusRepository $reservationStatusRepository) {
        $this->platenRepository      = $platenRepository;
        $this->reservationRepository = $reservationRepository;
        $this->reservationStatusRepository = $reservationStatusRepository;
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
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {   $minDate = Carbon::now()->timestamp;
        $request['visit-date'] = Carbon::parse($request['visit-date'])->timestamp;
        $this->validate($request, [
            'platen-id' => 'required|integer',
            'visit-date' => "required|numeric|min:{$minDate}",
            'persons-count' => 'required|max:65535'
        ]);

        $reservation = new Reservation();
        $reservation->platen_id = $request['platen-id'];
        $reservation->date = Carbon::createFromTimestamp($request['visit-date'])->toDateTimeString();
        $reservation->status_id = $this->reservationStatusRepository->getIdByTitle(ReservationStatus::NEW);
        $reservation->count_persons = $request['persons-count'];
        $this->reservationRepository->save($reservation);
        $reservations = $this->reservationRepository->getAll();

        return redirect()->route('reservation.index')
            ->with('reservations', $reservations);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $reservation = $this->reservationRepository->find($id);

        return view('reservation.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(23);
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
        dd(23);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(23);
    }
}

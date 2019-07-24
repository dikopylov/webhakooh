<?php

namespace App\Http\Controllers;

use App\Http\Models\Platen\Platen;
use App\Http\Models\Platen\PlatenRepository;
use App\Http\Models\Reservation\ReservationRepository;
use Illuminate\Http\Request;

class PlatenController extends Controller
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
        $this->middleware(['auth', 'check.admin' ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $platens = $this->platenRepository->getWithPagination();
        return view('platens.index')->with('platens', $platens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('platens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->request->all();

        $validator = \Validator::make($requestData, [
            'title'           =>'required|max:255',
            'platen_capacity' =>'required|integer|between:1,255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $platen = new Platen();
        $platen->capacity  = (int) $request['platen_capacity'];
        $platen->title     = $request['title'];

        $this->platenRepository->save($platen);

        $platens = $this->platenRepository->getWithPagination();

        return view('platens.index',
            [
                'platens' => $platens,
                'message' => 'Стол успешно создан!'
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $platen = $this->platenRepository->find($id);

        return view('platens.edit', compact('platen'));
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
        $requestData = $request->request->all();
        $message     = null;

        $validator = \Validator::make($requestData, [
            'title'=>'required|max:255',
            'platen_capacity' =>'required|integer|between:1,255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $platen = $this->platenRepository->find($id);
        $platen->capacity  = (int) $request['platen_capacity'];
        $platen->title     = $request['title'];
        if ($platen->isDirty()) {
            $message = 'Стол успешно отредактирован!';
            $this->platenRepository->save($platen);
        }
        $platens = $this->platenRepository->getWithPagination();

        return view('platens.index',
            [
                'platens' => $platens,
                'message' => $message
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return void
     */
    public function destroy($id)
    {
        $this->reservationRepository->deleteByPlatenId($id);
        $this->platenRepository->delete($id);
    }
}

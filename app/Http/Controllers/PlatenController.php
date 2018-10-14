<?php

namespace App\Http\Controllers;

use App\Http\Models\Platen\PlatenRepository;
use Illuminate\Http\Request;

class PlatenController extends Controller
{

    /**
     * @var PlatenRepository
     */
    private $platenRepository;

    public function __construct(PlatenRepository $platenRepository) {
        $this->platenRepository = $platenRepository;
        $this->middleware(['auth', 'check.admin' ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $platens = $this->platenRepository->getAll();
        return view('administration.platen.index')->with('platens', $platens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administration.platen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required|max:255',
            'capacity' =>'required|numeric',
        ]);

        $this->platenRepository->create($request->only('title', 'capacity'));
        $platens = $this->platenRepository->getAll();

        return redirect()->route('platen.index')
            ->with('platens', $platens);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $platen = $this->platenRepository->findOrFail($id); //Find post of id = $id

        return view ('administration.platen.show', compact('platen'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $platen = $this->platenRepository->findOrFail($id);

        return view('administration.platen.edit', compact('platen'));
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
        $this->validate($request, [
            'title'=>'required|max:255',
            'capacity' =>'required|numeric',
        ]);

        $platen = $this->platenRepository->findOrFail($id);
        $platen->title = $request->input('title');
        $platen->capacity = $request->input('capacity');
        $platen->save();

        return redirect()->route('administration.platen.show',
            $platen->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $platen = $this->platenRepository->findOrFail($id);
        $platen->is_delete = true;
        $platen->save();

        return redirect()->route('platen.index');
    }
}

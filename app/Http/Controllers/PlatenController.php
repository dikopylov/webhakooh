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
        $this->validate($request, [
            'title'=>'required|max:255',
            'platen_capacity' =>'required|integer|between:1,255',
        ]);

        $this->platenRepository->create($request->only('title', 'platen_capacity'));

        $platens = $this->platenRepository->getAll();

        return redirect()->route('platens.index')
            ->with('platens', $platens)->with('success', 'Стол успешно создан!');
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
        $this->validate($request, [
            'title'=>'required|max:255',
            'platen_capacity' =>'required|integer|between:1,255',
        ]);

        $this->platenRepository->update(
            $id,
            $request->input('title'),
            $request->input('platen_capacity')
        );

        $platens = $this->platenRepository->getAll();

        return redirect()->route('platens.index')
            ->with('platens', $platens)
            ->with('success', 'Стол успешно отредактирован!');
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
        $this->platenRepository->delete($id);
    }
}

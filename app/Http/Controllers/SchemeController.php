<?php

namespace App\Http\Controllers;

use App\Http\Models\Scheme\SchemeRepository;
use \App\Http\Models\Scheme\Scheme;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    /**
     * @var SchemeRepository
     */
    private $schemeRepository;

    public function __construct(SchemeRepository $schemeRepository)
    {
        $this->schemeRepository = $schemeRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('scheme.show',
            [
                'scheme' => $this->schemeRepository->get(),
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('scheme.edit');
    }


    /**
     * @param Request $request
     * @param Scheme $scheme
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, Scheme $scheme)
    {
        $path = $request['scheme-file']->path();
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $scheme->base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $scheme->name   = 'scheme-file';
        $this->schemeRepository->deleteOld();
        $this->schemeRepository->save($scheme);
        return $this->show();
    }
}

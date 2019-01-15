<?php

namespace App\Http\Controllers;

use App\Http\Models\Scheme\PlatensSchemeRepository;
use \App\Http\Models\Scheme\PlatensScheme;
use Illuminate\Http\Request;

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
     * @param PlatensScheme $scheme
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, PlatensScheme $scheme)
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

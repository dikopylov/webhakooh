<?php

namespace App\Http\Controllers;

use App\Http\Models\Scheme\SchemeRepository;
use App\Http\Models\Scheme\SchemeService;
use \App\Http\Models\Scheme\Scheme;
use Illuminate\Http\Request;
use Symfony\Component\Finder\SplFileInfo;

class SchemeController extends Controller
{
    private $schemeRepository;

    public function __construct(SchemeRepository $schemeRepository)
    {
        $this->schemeRepository = $schemeRepository;
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        return view('scheme.show',
            [
                'scheme' => $this->schemeRepository->get(),
            ]);
    }

    public function edit()
    {
        return view('scheme.edit');
    }


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

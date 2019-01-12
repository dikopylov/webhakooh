<?php

namespace App\Http\Controllers;

use App\Http\Models\Scheme\SchemeService;
use App\Scheme;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        return view('scheme.show',
            [
                'scheme' => SchemeService::getScheme(),
            ]);
    }

    public function edit()
    {
        return view('scheme.edit',
            [
                'scheme' => SchemeService::getScheme(),
            ]);
    }


    public function update(Request $request)
    {
        //
    }
}

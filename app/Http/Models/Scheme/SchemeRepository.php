<?php

namespace App\Http\Models\Scheme;

class SchemeRepository
{
    public function get()
    {
        return Scheme::all()->first();
    }

    public function save(Scheme $scheme)
    {
        return $scheme->save();
    }

    public function deleteOld()
    {
        return Scheme::destroy($this->get()->id);
    }
}
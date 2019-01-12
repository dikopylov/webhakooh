<?php

namespace App\Http\Models\Scheme;

class SchemeRepository
{
    /**
     * @return mixed
     */
    public function get()
    {
        return Scheme::all()->first();
    }

    /**
     * @param Scheme $scheme
     * @return bool
     */
    public function save(Scheme $scheme)
    {
        return $scheme->save();
    }

    /**
     * @return int
     */
    public function deleteOld()
    {
        return Scheme::destroy($this->get()->id);
    }
}
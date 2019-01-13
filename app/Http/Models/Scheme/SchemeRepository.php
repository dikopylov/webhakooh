<?php

namespace App\Http\Models\Scheme;

class SchemeRepository
{
    /**
     * @return Scheme
     */
    public function get() : Scheme
    {
        return Scheme::all()->first();
    }

    /**
     * @param Scheme $scheme
     * @return bool
     */
    public function save(Scheme $scheme) : bool
    {
        return $scheme->save();
    }

    /**
     * @return int
     */
    public function deleteOld() : int
    {
        return Scheme::destroy($this->get()->id);
    }
}
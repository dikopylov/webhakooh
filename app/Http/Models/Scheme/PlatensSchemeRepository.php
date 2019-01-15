<?php

namespace App\Http\Models\Scheme;

class PlatensSchemeRepository
{
    /**
     * @return PlatensScheme
     */
    public function get() : PlatensScheme
    {
        return PlatensScheme::all()->first();
    }

    /**
     * @param PlatensScheme $scheme
     * @return bool
     */
    public function save(PlatensScheme $scheme) : bool
    {
        return $scheme->save();
    }

    /**
     * @return int
     */
    public function deleteOld() : int
    {
        return PlatensScheme::destroy($this->get()->id);
    }
}
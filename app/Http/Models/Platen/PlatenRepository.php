<?php

namespace App\Http\Models\Platen;


class PlatenRepository
{
    public function getAll()
    {
        return Platen::where('is_delete', false)->get();
    }


}
<?php

namespace App\Http\Models\Platen;

use Illuminate\Database\Eloquent\Model;

class Platen extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'title', 'capacity', 'is_delete'
    );

}

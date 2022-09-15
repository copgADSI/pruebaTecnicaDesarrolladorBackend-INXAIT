<?php

namespace App\Models\city;

use App\Models\State\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'city',
        'state_id'
    ];

    /* RELATIONSHIPS */
    public function state()
    {
        return $this->hasOne(State::class,'state_id', 'id');
    }
}

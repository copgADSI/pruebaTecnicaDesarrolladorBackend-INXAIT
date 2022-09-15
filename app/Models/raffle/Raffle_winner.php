<?php

namespace App\Models\raffle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle_winner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /* RELATIONSHIPS */

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}

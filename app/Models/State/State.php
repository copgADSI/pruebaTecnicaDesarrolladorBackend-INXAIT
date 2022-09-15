<?php

namespace App\Models\State;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    const COL_STATES = [
        'Amazonas', 'Antioquia', 'Arauca', 'Atlántico',
        'Bogotá', 'Bolívar', 'Boyacá', 'Caldas', 'Caquetá',
        'Casanare',  'Cauca', 'Cesar', 'Chocó', 'Córdoba',
        'Cundinamarca', 'Guainía', 'Guaviare', 'Huila',
        'La Guajira', 'Magdalena', 'Meta', 'Nariño',
        'Norte de Santander', 'Putumayo', 'Quindío',
        'Risaralda', 'San Andrés y Providencia', 'Santander',
        'Sucre', 'Tolima', 'Valle del Cauca', 'Vaupés', 'Vichada'
    ];
    
    protected $fillable = [
        'state'
    ];

    /* RELATIONSHIPS */
    public function user()
    {
        return  $this->belongsTo(User::class, 'state_id',  'id');
    }
}

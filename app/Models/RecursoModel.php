<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecursoModel extends Model
{
    use HasFactory;

    protected $table = 'recurso';
    protected $fillable = [
        'recurso',
        'saldo_disponivel',
        'created_at',
        'updated_at'

    ];

    protected $visible = [
        'id',
        'recurso',
        'saldo_disponivel'
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    

}

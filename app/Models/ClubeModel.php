<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubeModel extends Model
{
    use HasFactory;

    protected $table = 'clube';
    
    protected $fillable = [
        'clube',
        'saldo_disponivel',
        'api_access_key'

    ];

    protected $visible = [
        'id',
        'clube',
        'saldo_disponivel'
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    

}

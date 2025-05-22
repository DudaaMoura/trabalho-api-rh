<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Functionary extends Model
{
    protected $table = 'functionaries'; //referenia a tabela
    protected $fillable = ['name', 'email', 'departament_id'];   
    public function departament()
    {
        return $this->belongsTo(Departament::class, 'departament_id');
    }                                                                           
}

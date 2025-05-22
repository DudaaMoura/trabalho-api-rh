<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $table = 'departaments'; //referenia a tabela
    protected $fillable = ['name'];

    public function functionaries()
    {
        return $this->hasMany(\App\Models\Functionary::class, 'departament_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public function categoria(){
        return $this->belongsTo(Categoria::class , 'Categoria_id');
    }

    public function marca(){
        return $this->belongsTo(Marca::class ,'marca_id');
    }


}

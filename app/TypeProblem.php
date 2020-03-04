<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProblem extends Model
{

    public function problem(){
        return $this->belongsTo(Problem::class);
    }
}

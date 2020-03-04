<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function system(){
        return $this->belongsTo(System::class);
    }
    public function typeProblem(){
        return $this->hasMany(TypeProblem::class);
    }
}

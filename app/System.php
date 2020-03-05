<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function problem(){
        return $this->hasMany(Problem::class);
    }
}

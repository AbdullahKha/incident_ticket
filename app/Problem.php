<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $casts=[
        'dateTime_problem'=>'dateTime'
    ];
    protected $fillable=[
        'dateTime_problem'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
    public function solve(){
        return $this->belongsTo(User::class, 'solved_by_user_id');
    }
    public function system(){
        return $this->belongsTo(System::class);
    }
    public function typeProblem(){
        return $this->belongsTo(TypeProblem::class,'TypeProblem_id');
    }
}

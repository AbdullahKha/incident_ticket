<?php

namespace App\Observers;

use App\Problem;

class ProblemObserver
{

    public function creating(Problem $problem)
    {

        $problem->created_by_user_id = \Auth::user()->id;
      // $problem->solved_by_user_id = \Auth::user()->id;

    }
    //
}

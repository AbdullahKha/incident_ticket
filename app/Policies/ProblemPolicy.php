<?php

namespace App\Policies;

use App\Problem;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProblemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the tag.
     *
     * @param  \App\User  $user
     * @param  \App\Tag  $tag
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo("view problem");
    }

    /**
     * @param User $user
     * @param Problem $problem
     * @return bool
     */
    public function view(User $user, Problem $problem)
    {
        return $this->checkPermissionTo("view", $user, $problem);
    }

    /**
     * Determine whether the user can create bios.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

        return $user->hasPermissionTo("create problem");

    }

    /**
     * Determine whether the user can update the bio.
     *
     * @param  \App\User  $user
     * @param  \App\Bio  $bio
     * @return mixed
     */
    public function update(User $user, Problem $problem)
    {
        return $this->checkPermissionTo("edit", $user, $problem);
    }

    /**
     * Determine whether the user can delete the bio.
     *
     * @param  \App\User  $user
     * @param  \App\Bio  $bio
     * @return mixed
     */
    public function delete(User $user, Problem $problem)
    {
        return $this->checkPermissionTo("delete", $user, $problem);
    }

    /**
     * Determine whether the user can restore the bio.
     *
     * @param  \App\User  $user
     * @param  \App\Bio  $bio
     * @return mixed
     */
    public function restore(User $user, Problem $problem)
    {
        return $this->checkPermissionTo("delete", $user, $problem);
    }

    /**
     * Determine whether the user can permanently delete the bio.
     *
     * @param  \App\User  $user
     * @param  \App\Bio  $bio
     * @return mixed
     */
    public function forceDelete(User $user, Problem $problem)
    {
        return $this->checkPermissionTo("delete", $user, $problem);
    }

    /**
     * [checkPermissionTo]
     * @param  [type] $type
     * @param  [type] $user
     * @param  [type] $account
     * @return [type]
     */
    private function checkPermissionTo($type, $user,$problem) {
        if ($user->hasPermissionTo($type." problem")==false) return false;
        if ($user->hasPermissionTo("access others resources")) return true;
        return $user->id === $problem->created_by;
    }
}

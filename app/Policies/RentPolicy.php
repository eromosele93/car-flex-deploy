<?php

namespace App\Policies;

use App\Models\Rent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Rent $rent): bool|Response
    {
        if($rent->user->id === $user->id){
            return true;
        }
       
        else{
            return Response::deny('Cannot see bookings on a post you did not list');
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Rent $rent): bool|Response
    {
        if($rent->user->id === $user->id ){
            return true;
        }
       
        else{
            return Response::deny(' Cannot edit a post you did not list');
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Rent $rent): bool|Response
    {
        if($rent->user->id === $user->id ){
            return true;
        }
       
        else{
            return Response::deny(' Cannot delete a post you did not list');
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rent $rent): bool|Response
    {
        if($rent->user->id === $user->id ){
            return true;
        }
       
        else{
            return Response::deny(' Cannot restore a post you did not list');
        }
    }
    public function image(User $user, Rent $rent): bool|Response{
        if($rent->user->id === $user->id){
            return true;
        }
       
        else{
            return Response::deny('Cannot upload an image on a post you did not list');
        }
    }

    public function booking(User $user, Rent $rent):bool|Response{
        if($rent->user->id === $user->id){
            return Response::deny('Cannot make an offer on a post you listed');
        }
       
        else{
           return true;
        }
    }
    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rent $rent): bool
    {
        return false;
    }
}

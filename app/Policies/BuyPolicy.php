<?php

namespace App\Policies;

use App\Models\Buy;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BuyPolicy
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
    public function view(User $user, Buy $buy): bool|Response
    {
        if($buy->user->id === $user->id){
            return true;
        }
       
        else{
            return Response::deny('Cannot see offers on a post you did not list');
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create( User $user): bool
    {
    return false;
      
    }

    public function image(User $user, Buy $buy): bool|Response{
        if($buy->user->id === $user->id){
            return true;
        }
       
        else{
            return Response::deny('Cannot upload an image on a post you did not list');
        }
    }

    public function offer(User $user, Buy $buy):bool|Response{
        if($buy->user->id === $user->id){
            return Response::deny('Cannot make an offer on a post you listed');
        }
       
        else{
           return true;
        }
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Buy $buy): bool|Response
    {
        if($buy->user->id === $user->id && $buy->sold_at === null){
            return true;
        }
       
        else{
            return Response::deny('Either the listing is sold or you Cannot edit a post you did not list');
        }
         
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Buy $buy): bool|Response
    {
        if($buy->user->id === $user->id && $buy->sold_at === null){
            return true;
        }
       
        else{
            return Response::deny('Either the listing is sold or you Cannot delete a post you did not list');
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Buy $buy): bool|Response
    {
        if($buy->user->id === $user->id){
            return true;
        }
       
        else{
            return Response::deny('Cannot Restore a post you did not list');
        }
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Buy $buy): bool
    {
        return false;
    }
}

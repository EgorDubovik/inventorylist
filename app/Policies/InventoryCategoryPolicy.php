<?php

namespace App\Policies;

use App\Models\InventoryCategory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class InventoryCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryCategory  $inventoryCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, InventoryCategory $inventoryCategory)
    {
        return in_array(Role::ADMIN,Auth::user()->roles->pluck('role')->toArray()) || $user->id == $inventoryCategory->user_id || $inventoryCategory->accesses->contains('user_id',$user->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $roles = Auth::user()->roles->pluck('role')->toArray();
        if (in_array(Role::ADMIN, $roles) || in_array(Role::FORMAN, $roles))
            return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryCategory  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, InventoryCategory $category)
    {
        $roles = Auth::user()->roles->pluck('role')->toArray();
        if ((in_array(Role::ADMIN, $roles) && $category->company_id == $user->company_id) || (in_array(Role::FORMAN, $roles) && $user->id == $category->user_id) || $category->accesses->contains('user_id',$user->id));
            return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryCategory  $category
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, InventoryCategory $category)
    {
        $roles = Auth::user()->roles->pluck('role')->toArray();
        if ((in_array(Role::ADMIN, $roles) && $category->company_id == $user->company_id) || (in_array(Role::FORMAN, $roles) && $user->id == $category->user_id) || $category->accesses->contains('user_id',$user->id))
            return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryCategory  $inventoryCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, InventoryCategory $inventoryCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\InventoryCategory  $inventoryCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, InventoryCategory $inventoryCategory)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  $user
     * @return mixed
     */
    public function viewAny($user = null)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function view($user = null, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  $user
     * @return mixed
     */
    public function create($user = null)
    {
        return $this->authorize($user,'catalog/product','modify');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function update($user = null, Product $product)
    {
        return $this->authorize($user,'catalog/product','modify');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  $user
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function delete($user = null, Product $product)
    {
        return $this->authorize($user,'catalog/product','modify');
    }
}

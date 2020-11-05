<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  $user
     * @return mixed
     */
    public function modify($user = null)
    {
        return $this->authorize($user,'catalog/product','modify');
    }
}

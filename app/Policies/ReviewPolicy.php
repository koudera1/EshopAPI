<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update products.
     *
     * @param  $user
     * @return mixed
     */
    public function modify($user = null)
    {
        return $this->authorize($user,'catalog/review','modify');
    }
}

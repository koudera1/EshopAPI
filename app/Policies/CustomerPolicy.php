<?php

namespace App\Policies;

use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param Customer $customer
     * @return mixed
     */
    public function updateByAdminOrAuthenticatedCustomer($user = null, Customer $customer)
    {
        return $this->authorize($user,'sale/order','modify', null, $customer);
    }
}

<?php

namespace App\Policies;

use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy extends Policy
{
    use HandlesAuthorization;

    public function accessByAdmin($user = null)
    {
        return $this->authorize($user,'sale/customer','access', null, null);
    }

    public function accessByAdminOrAuthenticatedCustomer($user = null, Customer $customer)
    {
        return $this->authorize($user,'sale/customer','access', null, $customer);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param Customer $customer
     * @return mixed
     */
    public function updateByAdminOrAuthenticatedCustomer($user = null, Customer $customer)
    {
        return $this->authorize($user,'sale/customer','modify', null, $customer);
    }
}

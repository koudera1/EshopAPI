<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Customer_group;
use Illuminate\Auth\Access\HandlesAuthorization;

class Customer_groupPolicy extends Policy
{
    use HandlesAuthorization;

    public function access($user = null)
    {
        return $this->authorize($user,'sale/customer_group','access');
    }

    public function modify($user = null)
    {
        return $this->authorize($user,'sale/customer_group','modify');
    }
}

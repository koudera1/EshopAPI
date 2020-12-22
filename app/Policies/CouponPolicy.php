<?php

namespace App\Policies;

use App\Models\Coupon;
use App\Models\Customer;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouponPolicy extends Policy
{
    use HandlesAuthorization;

    public function access($user = null)
    {
        return $this->access($user,'sale/coupon','access');
    }

    public function modify($user = null)
    {
        return $this->authorize($user,'sale/coupon','modify');
    }
}

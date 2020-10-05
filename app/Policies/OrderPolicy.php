<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy extends Policy
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
        return $this->authorize($user,'sale/order','access');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  $user
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function view($user = null, $order)
    {
        return $this->authorize($user,'sale/order','access', $order);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  $user
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function accessOrModifyByCustomer($user = null, Order $order)
    {
        if(session('ip_address') === $order->ip)
            return true;
        else return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function accessByAdminOrCustomer($user = null, Order $order)
    {
        return $this->authorize($user,'sale/order','access', $order);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function updateByAdminOrCustomer($user = null, Order $order)
    {
        return $this->authorize($user,'sale/order','modify', $order);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function updateByAdmin($user = null, Order $order)
    {
        return $this->authorize($user,'sale/order','modify');
    }

}

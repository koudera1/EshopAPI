<?php

namespace App\Policies;

use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy extends Policy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the model.
     *
     * @param  $user
     * @param Order $order
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
     * @param Order|null $order
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
     * @param Order $order
     * @return mixed
     */
    public function updateByAdmin($user = null, Order $order)
    {
        return $this->authorize($user,'sale/order','modify');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  $user
     * @return mixed
     */
    public function accessByAdmin($user = null)
    {
        return $this->authorize($user,'sale/order','access');
    }

}

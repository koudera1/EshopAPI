<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\DB;

class Policy
{
    use HandlesAuthorization;

    public function authorize($user, $needle, $action, Order $order = null, Customer $customer = null)
    {
        return true;
        if($user instanceof User)
        {
            $permission = unserialize(DB::table('oc_user_group')
                ->where('user_group_id',$user->user_group_id)
                ->value('permission'));
            if ($permission === null) return false;
            $key = array_search($needle,$permission[$action]);
            if($key === false) return false;
            else return true;
        }
        else if($order != null)
        {
            if(session('ip_address') === $order->ip)
                return true;
            else return false;
        }
        else if($user instanceof Customer)
        {
            if($user->customer_id === $customer->customer_id)
                return true;
            else return false;
        }
        else return false;
    }
}

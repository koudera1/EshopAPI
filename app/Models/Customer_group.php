<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer_group extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oc_customer_group';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'customer_group_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}

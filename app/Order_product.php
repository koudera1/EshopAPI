<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oc_order_product';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_product_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'name', 'tax', 'quantity',
        'sort_order', 'is_transfer', 'is_action', 'gift', 'model',
        'price', 'purchase_price', 'warranty', 'total'];

}
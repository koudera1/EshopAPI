<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Order_product_move extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oc_order_product_move';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_product_move_id';

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
    protected $guarded = [];

    /**
     * Scope a query to get order products of specified order.
     *
     * @param Builder $query
     * @param $id
     * @return Builder[]|Collection
     */
    public function scopeGetByIds($query, $order_id, $product_id)
    {
        return $query->where('product_id', $product_id)
            ->where('order_id', $order_id)->firstOrFail();
    }

    /**
     * Scope a query to get order product move by id.
     *
     * @param Builder $query
     * @param $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function scopeGetById($query, $id)
    {
        return $query->findOrFail($id);
    }
}

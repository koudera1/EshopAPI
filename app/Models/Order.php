<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oc_order';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'order_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    const CREATED_AT = 'date_added';
    const UPDATED_AT = 'date_modified';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Scope a query to get order information.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeGetInformation($query)
    {
        return $query
            ->leftjoin('oc_order_status', 'oc_order.order_status_id', '=', 'oc_order_status.order_status_id')
            ->leftjoin('oc_order_product', 'oc_order.order_id', '=', 'oc_order_product.order_id')
            ->leftjoin('geis_package', 'oc_order.order_id', '=', 'geis_package.order_id')
            ->leftjoin('postcz_package', 'oc_order.order_id', '=', 'postcz_package.order_id')
            ->leftjoin('zasilkovna_package', 'oc_order.order_id', '=', 'zasilkovna_package.order_id')
            ->leftjoin('oc_order_product_move', 'oc_order.order_id', '=', 'oc_order_product_move.order_id')
            ->select('oc_order.order_id', 'oc_order.invoice_id', 'oc_order.domain',
                'oc_order.firstname', 'oc_order.lastname', 'oc_order.comment',
                'oc_order_status.name as order_status', 'oc_order.shipping_method',
                DB::raw('IF((geis_package.package_order IS NOT NULL) OR (postcz_package.package_order IS NOT NULL)
                    OR (zasilkovna_package.creation_time IS NOT NULL),1,0) as label'),
                'oc_order.date_added', 'oc_order.total', 'oc_order.payment_status',
                DB::raw('(SUM((oc_order_product.price - oc_order_product.purchase_price) * oc_order_product.quantity)) / 
                (sqrt(count(oc_order_product_move.order_product_move_id))) as profit'),
                DB::raw('(IF(oc_order.shipping_country = "Slovensko",1,0)) as slovakia'),
                DB::raw('(IF((SELECT SUM(quantity_ext) FROM oc_order_product_move) = 0,1,0)) as instock'),
                'oc_order.referrer', 'oc_order.agree_gdpr', 'oc_order.payment_method', 'oc_order.email', 'oc_order.telephone');
    }

    /**
     * Scope a query to get order by id.
     *
     * @param Builder $query
     * @param $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function scopeGetById($query, $id)
    {
         return $query->findOrFail($id);
    }


    /**
     * Scope a query to select addresses.
     *
     * @param Builder $query
     * @return Builder|Builder[]|Collection|Model
     */
    public function scopeSelectAddresses($query)
    {
        return $query->select('shipping_firstname', 'shipping_lastname', 'shipping_company', 'shipping_address_1',
            'shipping_address_2', 'shipping_city', 'shipping_postcode', 'shipping_zone', 'shipping_zone_id',
            'shipping_country', 'shipping_country_id', 'shipping_address_format',
            'payment_firstname', 'payment_lastname', 'payment_company', 'payment_address_1', 'payment_address_2',
            'payment_city', 'payment_postcode', 'payment_zone', 'payment_zone_id',
            'payment_country', 'payment_country_id', 'payment_address_format');
    }

    public function history()
    {
        return $this->hasMany('App\OrderHistory', 'order_id');
    }
}

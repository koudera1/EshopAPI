<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oc_product';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

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
     * Scope a query to get product by id.
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_special extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oc_product_special';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'product_special_id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->date_added = date("Y-m-d H:i:s");
        });
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zasilkovna_package extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zasilkovna_package';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'package_id';

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
            $model->creation_time = date("Y-m-d H:i:s");
        });
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}

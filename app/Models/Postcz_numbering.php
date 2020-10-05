<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postcz_numbering extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'postcz_numbering';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'min';

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
}

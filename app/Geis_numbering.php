<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geis_numbering extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'geis_numbering';

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
}

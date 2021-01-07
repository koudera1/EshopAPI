<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oc_language';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'language_id';

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

    /**
     * Scope a query to get language id.
     *
     * @param Builder $query
     * @param $language
     * @return Builder|Builder[]|Collection|Model
     */
    public function scopeGetLanguageId($query, $language)
    {
        return $query->where('name',$language)
            ->value('language_id');
    }
}

<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'country_translations';
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'countries_trans_id';

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'countries_name'
    ];

    /**
     * Many to one relation with countries.
     *
     * @return collection of country
     */
    public function country()
    {
    	return $this->belongsTo('Modules\Main\Models\Country', 'countries_id', 'countries_id');
    }
}

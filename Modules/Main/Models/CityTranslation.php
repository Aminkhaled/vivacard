<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'city_translations';
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'cities_trans_id';

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
        'cities_name'
    ];

    /**
     * Many to one relation with cities.
     *
     * @return collection of city
     */
    public function city()
    {
    	return $this->belongsTo('Modules\Main\Models\City', 'cities_id', 'cities_id');
    }
}

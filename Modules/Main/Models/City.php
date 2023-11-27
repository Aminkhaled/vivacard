<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class City extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'cities';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'cities_id';
    protected $translationForeignKey = 'cities_id';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'cities_name'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'cities_created_at';
    const UPDATED_AT = 'cities_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'countries_id', 'cities_status', 'cities_position','cities_code'
    ];

      /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($city) {
            $city->branches()->delete();
        });
    }


    /**
     * Many to one relation with cities.
     *
     * @return collection of city
     */
    public function country()
    {
        return $this->belongsTo('Modules\Main\Models\Country', 'countries_id', 'countries_id');
    }

    /**
     * Many to one relation with Branch.
     *
     * @return collection of branch
     */
    public function branches()
    {
        return $this->hasMany('Modules\Branches\Models\Branch', 'cities_id', 'cities_id');
    }


    /**
     * Many to one relation with categories.
     *
     * @return collection of category
     */
    public function clientAddresses()
    {
        return $this->hasMany('Modules\Main\Models\ClientAddresses', 'cities_id', 'cities_id');
    }

    /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query, $type='asc')
    {
        return $query->orderBy('cities_position', $type)->orderBy('cities.cities_id', $type);
    }

    /**
     * Scope a query to fetch Active data only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('cities_status', '1');
    }

}

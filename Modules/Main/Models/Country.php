<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class Country extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'countries_id';
    protected $translationForeignKey = 'countries_id';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'countries_name'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'countries_created_at';
    const UPDATED_AT = 'countries_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'countries_status','countries_code','countries_image', 'countries_position','countries_currency'
    ];


     /**
     * Set countries's image.
     *
     * @param string $file
     */
    public function setCountriesImageAttribute($file)
    {

        if ($file) {
            if (is_string($file)) {
                $this->attributes['countries_image'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->originalImage($file, $current_name,'countries');
                $this->mediumImage($file, $current_name,null,400,'countries');
                $this->thumbImage($file, $current_name,100,null,'countries');

                $this->attributes['countries_image'] = $current_name;
            }
        } else {
            $this->attributes['countries_image'] = null;
        }
    }

    /**
     * Many to one relation with countries.
     *
     * @return collection of country
     */
    public function cities()
    {
        return $this->hasMany('Modules\Main\Models\City', 'countries_id', 'countries_id');
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
        return $query->orderBy('countries_position', $type)->orderBy('countries.countries_id', $type);
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
        return $query->where('countries_status', '1');
    }

}

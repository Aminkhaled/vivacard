<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class Store extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'stores_id';
    protected $translationForeignKey = 'stores_id';

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'stores_created_at';
    const UPDATED_AT = 'stores_updated_at';


     /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'stores_name','stores_desc'
    ];


    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
       'stores_code','stores_link','stores_logo','stores_position','stores_status'
    ];

    /**
     * Set store's image.
     *
     * @param string $file
     */
    public function setStoresLogoAttribute($file)
    {

        if ($file) {
            if (is_string($file)) {
                $this->attributes['stores_logo'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->mediumImage($file, $current_name,600,null,'stores');
                $this->thumbImage($file, $current_name,100,null,'stores');
                $this->originalImage($file, $current_name,'stores');


                $this->attributes['stores_logo'] = $current_name;

            }
        } else {
            $this->attributes['stores_logo'] = null;
        }
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
        return $query->orderBy('stores.stores_position', $type)->orderBy('stores.stores_id', $type);
    }

    /**
     * Scope a query to fetch Active data only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSuccess($query)
    {
        return $query->where('payments_status', '1');
    }

    /**
     * one to Many relation with coupons.
     *
     * @return collection of coupon
     */
    public function coupons()
    {
        return $this->hasMany('Modules\Main\Models\Coupon', 'coupons_id', 'coupons_id');
    }

}

<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class Offer extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'offers';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'offers_id';
    protected $translationForeignKey = 'offers_id';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'offers_name'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'offers_created_at';
    const UPDATED_AT = 'offers_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'offers_image','offers_position','offers_status'
    ];

     /**
     * Set store's image.
     *
     * @param string $file
     */
    public function setOffersImageAttribute($file)
    {

        if ($file) {
            if (is_string($file)) {
                $this->attributes['offers_image'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->mediumImage($file, $current_name,600,null,'offers');
                $this->thumbImage($file, $current_name,100,null,'offers');
                $this->originalImage($file, $current_name,'offers');


                $this->attributes['offers_image'] = $current_name;

            }
        } else {
            $this->attributes['offers_image'] = null;
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
        return $query->orderBy('offers_position', $type)->orderBy('offers.offers_id', $type);
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
        return $query->where('offers_status', '1');
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

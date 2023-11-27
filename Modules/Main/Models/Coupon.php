<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class Coupon extends Model
{
    use \Astrotomic\Translatable\Translatable,StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'coupons_id';
    protected $translationForeignKey = 'coupons_id';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'coupons_name','coupons_long_name','coupons_desc','coupons_offers_desc'
    ];
    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'coupons_created_at';
    const UPDATED_AT = 'coupons_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'stores_id','offers_id','coupons_image','coupons_code','coupons_position','coupons_click_counts','coupons_status','coupons_available','coupons_is_special'
    ];

    /**
     * Set category's image.
     *
     * @param string $file
     */
    public function setCouponsImageAttribute($file)
    {
        if ($file) {
            if (is_string($file)) {
                $this->attributes['coupons_image'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->mediumImage($file, $current_name,600,null,'coupons');
                $this->thumbImage($file, $current_name,100,null,'coupons');
                $this->originalImage($file, $current_name,'coupons');

                $this->attributes['coupons_image'] = $current_name;
            }
        } else {
            $this->attributes['coupons_image'] = null;
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
        return $query->orderBy('coupons_position', $type)->orderBy('coupons.coupons_id', $type);
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
        return $query->where('coupons_status', '1');
    }

    /**
     * Scope a query to fetch Active data only.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('coupons_available', '1');
    }

    /**
     * Many to one relation with stores.
     *
     * @return collection of store
     */
    public function store()
    {
    	return $this->belongsTo('Modules\Main\Models\Store', 'stores_id', 'stores_id');
    }

    /**
     * Many to one relation with offers.
     *
     * @return collection of offer
     */
    public function offer()
    {
    	return $this->belongsTo('Modules\Main\Models\Offer', 'offers_id', 'offers_id');
    }

    /**
     * Many to Many relation with categories.
     *
     * @return collection of categories
     */
    public function categories()
    {
    return $this->belongsToMany('Modules\Main\Models\Category', 'coupon_categories','coupons_id','categories_id');
    }

    /**
     * Many to Many relation with countries.
     *
     * @return collection of countries
     */
    public function countries()
    {
    return $this->belongsToMany('Modules\Main\Models\Country', 'coupon_countries','coupons_id','countries_id');
    }

}

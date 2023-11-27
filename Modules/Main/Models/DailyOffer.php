<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class DailyOffer extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'daily_offers';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'daily_offers_id';
    protected $translationForeignKey = 'daily_offers_id';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'daily_offers_name'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'daily_offers_created_at';
    const UPDATED_AT = 'daily_offers_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'daily_offers_code','stores_id','daily_offers_image','daily_offers_url', 'daily_offers_price','daily_offers_price_before_sale','daily_offers_position','daily_offers_status'
    ];

    /**
     * Set category's image.
     *
     * @param string $file
     */
    public function setDailyOffersImageAttribute($file)
    {

        if ($file) {
            if (is_string($file)) {
                $this->attributes['daily_offers_image'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->mediumImage($file, $current_name,600,null,'daily_offers');
                $this->thumbImage($file, $current_name,100,null,'daily_offers');
                $this->originalImage($file, $current_name,'daily_offers');

                $this->attributes['daily_offers_image'] = $current_name;
            }
        } else {
            $this->attributes['daily_offers_image'] = null;
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
        return $query->orderBy('daily_offers_position', $type)->orderBy('daily_offers.daily_offers_id', $type);
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
        return $query->where('daily_offers_status', '1');
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
}

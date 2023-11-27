<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class CouponTranslation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'coupon_translations';
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'coupons_trans_id';

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
        'coupons_name','coupons_long_name','coupons_desc','coupons_offers_desc'
    ];

    /**
     * Many to one relation with coupons.
     *
     * @return collection of coupon
     */
    public function coupon()
    {
    	return $this->belongsTo('Modules\Main\Models\Coupon', 'coupons_id', 'coupons_id');
    }
}

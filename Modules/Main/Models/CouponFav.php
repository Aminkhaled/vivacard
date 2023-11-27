<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class CouponFav extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'coupon_favs';
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'coupon_favs_id';

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
        'coupons_id','customers_id'
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

    /**
     * Many to one relation with coupons.
     *
     * @return collection of coupon
     */
    public function customer()
    {
    	return $this->belongsTo('Modules\Main\Models\Customer', 'customers_id', 'customers_id');
    }
}

<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class DailyOfferTranslation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'daily_offer_translations';
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'daily_offers_trans_id';

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
        'daily_offers_name'
    ];

    /**
     * Many to one relation with daily_offers.
     *
     * @return collection of daily_offer
     */
    public function daily_offer()
    {
    	return $this->belongsTo('Modules\Main\Models\DailyOffer', 'daily_offers_id', 'daily_offers_id');
    }
}

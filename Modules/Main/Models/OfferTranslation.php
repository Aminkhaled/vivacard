<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class OfferTranslation extends Model
{
    
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'offer_translations';
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'offers_trans_id';

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
        'offers_name','offers_desc'
    ];

}

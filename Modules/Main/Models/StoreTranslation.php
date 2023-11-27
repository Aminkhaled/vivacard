<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class StoreTranslation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'store_translations';
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'stores_trans_id';

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
        'stores_name','stores_desc'
    ];

    /**
     * Many to one relation with stores_id.
     *
     * @return collection of customers_package
     */
    public function store()
    {
    	return $this->belongsTo('Modules\Main\Models\Store', 'stores_id', 'stores_id');
    }
}

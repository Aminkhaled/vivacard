<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;

class InfoTranslation extends Model
{
    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'info_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'infos_trans_id';

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
        'infos_title', 'infos_desc'
    ];

    /**
     * Many to one relation with infos.
     *
     * @return collection of info
     */
    public function info()
    {
    	return $this->belongsTo('Modules\General\Models\Info', 'infos_id', 'infos_id');
    }
}

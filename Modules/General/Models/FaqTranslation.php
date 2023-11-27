<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class FaqTranslation extends Model
{
    use  StorageHandle;

    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */

    protected $table = 'faq_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'faqs_trans_id';

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
        'faqs_question','faqs_answer'
    ];

    /**
     * Many to one relation with branches.
     *
     * @return collection of branch
     */
    public function faq()
    {
    	return $this->belongsTo('Modules\General\Models\Faq', 'faqs_id', 'faqs_id');
    }
}

<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;

class ContactTranslation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'contact_translations';
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'contacts_trans_id';

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
        'contacts_address','contacts_text'
    ];

    /**
     * Many to one relation with contacts.
     *
     * @return collection of contact
     */
    public function contact()
    {
    	return $this->belongsTo('Modules\General\Models\Contact', 'contacts_id', 'contacts_id');
    }
}

<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon ;

class ContactUs extends Model
{
    protected $connection = 'mysql';
    /**
     *
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'contact_us_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_us_name','contact_us_phone','contact_us_email', 'contact_us_type', 'contact_us_message','customers_id','providers_id','orders_id'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'contact_us_created_at';
    const UPDATED_AT = 'contact_us_updated_at';

    /**
     * This will change date according to timezone.
     * @param String path
     */
    public function getContactUsCreatedAtAttribute($value)
    {
        return  Carbon::parse($value)->timezone(env('timezone','Africa/Cairo')) ;
    }
    public function getContactUsUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(env('timezone','Africa/Cairo')) ;
    }

        /**
     * Many to one relation with customers.
     *
     * @return collection of customer
     */
    public function customer()
    {
        return $this->belongsTo('Modules\Main\Models\Customer', 'customers_id', 'customers_id');
    }

}

<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class Advertisement extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    // use   StorageHandle;

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'advertisements_id';
    protected $translationForeignKey = 'advertisements_id';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'advertisements_text', 'advertisements_web_img','advertisements_phone_img','advertisements_url'
    ];

    /**
     *
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'advertisements_created_at';
    const UPDATED_AT = 'advertisements_updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advertisements_name', 'advertisements_status','advertisements_color','advertisements_view_page','advertisements_position','advertisements_link_type','advertisements_link_value'
    ];

    /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query )
    {
        return $query->orderBy('advertisements_position', 'asc')->orderBy('advertisements.advertisements_id', 'desc');
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
        return $query->where('advertisements_status', '1')->where('advertisements_type', 'website');
    }

    public function scopeAppHome($query)
    {
        return $query->where('advertisements_view_page', 'app_home') ;
    }

}

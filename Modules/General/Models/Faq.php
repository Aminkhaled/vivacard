<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class Faq extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;
    protected $connection = 'mysql';
    // use   StorageHandle;

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'faqs_id';
    protected $translationForeignKey = 'faqs_id';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'faqs_question','faqs_answer'
    ];

    /**
     *
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'faqs_created_at';
    const UPDATED_AT = 'faqs_updated_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'faqs_status','faqs_position'
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
        return $query->orderBy('faqs_position', 'asc')->orderBy('faqs.faqs_id', 'desc');
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
        return $query->where('faqs_status', '1');
    }

}

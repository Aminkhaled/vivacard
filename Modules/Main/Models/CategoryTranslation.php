<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'category_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'categories_trans_id';

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
        'categories_name','categories_slug','locale', 'categories_seo_title', 'categories_seo_desc' , 'categories_seo_keyword'
    ];

    /**
     * Many to one relation with categories.
     *
     * @return collection of category
     */
    public function category()
    {
    	return $this->belongsTo('Modules\Main\Models\Category', 'categories_id', 'categories_id');
    }
}

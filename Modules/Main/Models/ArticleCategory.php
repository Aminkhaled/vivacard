<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class ArticleCategory extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;

    /**
     * Table name.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'articles_categories';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'articles_categories_id';
    protected $translationForeignKey = 'articles_categories_id';
    
    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
       'articles_categories_name'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'articles_categories_created_at';
    const UPDATED_AT = 'articles_categories_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
         'articles_categories_status','articles_categories_position'
    ];
		/**
     * Many to one relation with category.
     *
     * @return collection of city
     */
    public function articles()
    {
        return $this->hasMany('Modules\Main\Models\Article', 'articles_categories_id', 'articles_categories_id');
    }


        /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query)
    {
        return $query->orderBy('articles_categories_position','asc')->orderBy('articles_categories.articles_categories_id', 'asc');
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
        return $query->where('articles_categories_status', '1');
    }

}

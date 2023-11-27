<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class Article extends Model
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;

    /**
     * Table name.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'articles';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'articles_id';
    protected $translationForeignKey = 'articles_id';
    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
       'articles_slug', 'articles_title' ,'articles_desc', 'articles_seo_title' ,'articles_seo_desc','articles_seo_keyword'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'articles_created_at';
    const UPDATED_AT = 'articles_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'articles_date','articles_image', 'articles_status', 'articles_categories_id','articles_position','articles_featured','articles_views'
    ];

    /**
     * Set services's image.
     *
     * @param string $file
     */
    public function setArticlesImageAttribute($file)
    {

        if ($file) {
            if (is_string($file)) {
                $this->attributes['articles_image'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->originalImage($file, $current_name,'articles');
                $this->mediumImage($file, $current_name,null,400,'articles');
                $this->thumbImage($file, $current_name,100,null,'articles');

                $this->attributes['articles_image'] = $current_name;
            }
        } else {
            $this->attributes['articles_image'] = null;
        }
    }

    public function getArticlesImageAttribute($value)
    {
        if(strpos($value,'.webp') && !supportWebp()){
            return checkAndReplaceWebpImage($value,'articles');
        }
        return $value ;
    }


    /**
     * Many to one relation with category.
     *
     * @return collection of city
     */
    public function category()
    {
        return $this->belongsTo('Modules\Main\Models\ArticleCategory', 'articles_categories_id', 'articles_categories_id');
    }


    /**
     * Many to one relation with article_translations.
     *
     * @return collection of article_translations
     */
    public function trans()
    {
        return $this->hasMany('Modules\Main\Models\ArticleTranslation', 'articles_id', 'articles_id');
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
        return $query->orderBy('articles_position','asc')->orderBy('articles.articles_id', 'desc');
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
        return $query->where('articles_status', '1');
    }

}

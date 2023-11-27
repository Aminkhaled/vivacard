<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'article_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'articles_trans_id';

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
        'articles_slug', 'articles_title' ,'articles_desc', 'articles_seo_title' ,'articles_seo_desc','articles_seo_keyword'
    ];

    /**
     * Many to one relation with articles.
     *
     * @return collection of article
     */
    public function articles()
    {
    	return $this->belongsTo('Modules\Main\Models\Article', 'articles_id', 'articles_id');
    }
}

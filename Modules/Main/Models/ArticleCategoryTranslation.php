<?php

namespace Modules\Main\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategoryTranslation extends Model
{
    
    /**
     * Table name.
     * 
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'articles_category_translations';

    /**
     * Primary key.
     * 
     * @var string
     */
    protected $primaryKey = 'articles_categories_trans_id';

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
        'articles_categories_name' 
    ];

    /**
     * Many to one relation with articles_categories.
     * 
     * @return collection of article
     */
    public function article()
    {
    	return $this->belongsTo('Modules\Main\Models\Article', 'articles_categories_id', 'articles_categories_id');
    }
}

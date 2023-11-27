<?php

namespace Modules\Main\Models;
use Baum\Node;
use DB;
use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class Category extends Node
{
    use \Astrotomic\Translatable\Translatable, StorageHandle;

    /**
     * Table name.
     *
     * @var string
     */
    protected $connection = 'mysql';
    protected $table = 'categories';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'categories_id';
    protected $translationForeignKey = 'categories_id';

    /**
     * Column name which stores reference to parent's node.
     *
     * @var string
     */
    protected $parentColumn = 'categories_parent_id';

    /**
     * Column name which Sort node.
     *
     * @var string
     */
    // protected $orderColumn = 'categories_position';

    /**
     * Translated attributes.
     *
     * @var array
     */
    public $translatedAttributes =  [
        'categories_name','categories_slug', 'categories_seo_title', 'categories_seo_desc' , 'categories_seo_keyword'
    ];

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'categories_created_at';
    const UPDATED_AT = 'categories_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'categories_code','categories_image', 'categories_status', 'categories_position','categories_parent_id'
    ];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Set category's image.
     *
     * @param string $file
     */
    public function setCategoriesImageAttribute($file)
    {

        if ($file) {
            if (is_string($file)) {
                $this->attributes['categories_image'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->mediumImage($file, $current_name,600,null,'categories');
                $this->thumbImage($file, $current_name,100,null,'categories');
                $this->originalImage($file, $current_name,'categories');


                $this->attributes['categories_image'] = $current_name;

            }
        } else {
            $this->attributes['categories_image'] = null;
        }
    }

    public function setCategoriesSlugAttribute()
    {
        $this->attributes['categories_slug'] = "{$this->categories_code}".' '."{$this->categories_name}";
    }
    /**
     * Many to one relation with category.
     *
     * @return collection of city
     */
    public function subCategories()
    {
        return $this->hasMany('Modules\Main\Models\Category', 'categories_parent_id', 'categories_id')->active()->with('subcategories')->frontSorted();
    }

    /**
     * Many to one relation with category.
     *
     * @return collection of city
     */
    public function subCategoriesids()
    {
        return $this->hasMany('Modules\Main\Models\Category', 'categories_parent_id', 'categories_id')->select('categories_id');
    }

      /**
     * Many to one relation with category.
     *
     * @return collection of category
     */
    public function category()
    {
        return $this->belongsTo('Modules\Main\Models\Category', 'categories_parent_id', 'categories_id');
    }

    /**
     * Many to one relation with category.
     *
     * @return collection of category
     */
    public function parent()
    {
        return $this->belongsTo('Modules\Main\Models\Category', 'categories_parent_id', 'categories_id');
    }

    /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query, $type='asc', $by='rgt')
    {
        return $query
        ->orderBy(DB::raw('coalesce(categories.lft, categories.'. $by .')'), $type)
        ->orderBy(DB::raw('categories.depth'),$type)
        // ->orderBy(DB::raw('categories.categories_parent_id IS NOT NULL'))
        ->orderBy('categories.categories_position', $type);
    }

   /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFrontSorted($query, $type='asc', $by='rgt')
    {
        return $query
        ->orderBy('categories.categories_position', $type)
        ->orderBy(DB::raw('coalesce(categories.lft, categories.'. $by .')'), $type)
        ->orderBy(DB::raw('categories.depth'),$type);
        // ->orderBy(DB::raw('categories.categories_parent_id IS NOT NULL'))
    }

        /**
     * Many to one relation with categories_translations.
     *
     * @return collection of categoriesTrans
     */
    public function trans()
    {
        return $this->hasMany('Modules\Main\Models\CategoryTranslation', 'categories_id', 'categories_id');
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
        return $query->where('categories.categories_status', '1');
    }

}

<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Models\StorageHandle;

class AdvertisementTranslation extends Model
{
    use  StorageHandle;

    protected $connection = 'mysql';
    /**
     * Table name.
     *
     * @var string
     */

    protected $table = 'advertisement_translations';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'advertisements_trans_id';

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
        'advertisements_text','advertisements_web_img','advertisements_phone_img','advertisements_url'
    ];

    /**
     * Set services's image.
     *
     * @param string $file
     */
    public function setAdvertisementsWebImgAttribute($file)
    {

        if ($file) {
            if (is_string($file)) {
                $this->attributes['advertisements_web_img'] = $file;
            } else {
                $current_name = $this->currentName($file);

                $this->mediumImage($file, $current_name,null,40,'advertisements');
                $this->thumbImage($file, $current_name,100,null,'advertisements');
                $this->originalImage($file, $current_name,'advertisements'); // original must be after medium and thumbnailImage to prevent move file issue
                $this->compareImageSizes($current_name,'advertisements');

                $this->attributes['advertisements_web_img'] = $current_name;
            }
        } else {
            $this->attributes['advertisements_web_img'] = null;
        }
    }

    public function getAdvertisementsWebImgAttribute($value)
    {

        if(strpos($value,'.webp') && !supportWebp()){
            return checkAndReplaceWebpImage($value,'images');
        }
        return $value ;
    }

    public function setAdvertisementsPhoneImgAttribute($file)
    {
        if ($file) {
            if (is_string($file)) {
                $this->attributes['advertisements_phone_img'] = $file;
            } else {
                $current_name = $this->currentName($file);
                $this->mediumImage($file, $current_name,null,200);
                $this->thumbImage($file, $current_name,100,null);
                $this->originalImage($file, $current_name);// original must be after medium and thumbnailImage to prevent move file issue
                $this->compareImageSizes($current_name);
                $this->attributes['advertisements_phone_img'] = $current_name;
            }
        } else {
            $this->attributes['advertisements_phone_img'] = null;
        }
    }

    public function getAdvertisementsPhoneImgAttribute($value)
    {
        if(strpos($value,'.webp') && !supportWebp()){
            return checkAndReplaceWebpImage($value,'images');
        }
        return $value ;
    }

    /**
     * Many to one relation with branches.
     *
     * @return collection of branch
     */
    public function advertisement()
    {
    	return $this->belongsTo('Modules\General\Models\Advertisement', 'advertisements_id', 'advertisements_id');
    }
}

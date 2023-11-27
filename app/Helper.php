<?php

use Modules\General\Models\Info;
use Modules\General\Models\Setting;
use Modules\General\Models\MetaTag;
use Carbon\Carbon ;


/**
 * Get static Setting by it's key
 */

if (!function_exists('getSettingByKey')) {
    function getSettingByKey($key)
    {
        return Setting::where('settings_key', $key)->value('settings_value');
    }
}
if (!function_exists('textToHtml'))
{
    function textToHtml($value)
    {

        preg_match_all("'\*(.*?)\*'", $value, $matches);
        if(sizeof($matches) > 1){
            foreach($matches[1] as $key => $text){
                $newValue = '<span style="color:red">'.$text.'</span>' ;
                $value = str_replace($matches[0][$key],$newValue,$value);
            }
        }
        $value = nl2br($value);
        return $value ;
    }
}
if (!function_exists('format_price'))
{
    function format_price( $value, $decimal_digits = 3)
    {
        $value = number_format($value, $decimal_digits, '.', '');

        if($decimal_digits == 3)  return $value;

        // $value = rtrim($value, '0');
        $price = explode('.', $value);
        $precision = $price[0];
        if(isset($price[1])) {
            $scale = $price[1];
        } else {
            $scale = 0;
        }

        return $scale == 0 ? $precision : $value;
    }
}

if (!function_exists('supportWebp')) {
    function supportWebp(){
        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $platformVersion = $agent->version($platform);
        $version = $agent->version($browser);
        $version = explode('.',$version)[0];
        $support_webp = true ;
        if($browser == 'Chrome' && $version <= 31){
            $support_webp = false ;
        }elseif($browser == 'IE' && $version <= 11){
            $support_webp = false ;
        }elseif($browser == 'Safari' && $version <= 13){
            $support_webp = false ;
        }elseif($browser == 'Safari' && $version <= 15 && $platformVersion < 11){
            $support_webp = false ;
        }elseif($browser == 'Firefox' && $version <= 64){
            $support_webp = false ;
        }elseif($browser == 'Edge' && $version <= 17){
            $support_webp = false ;
        }elseif($browser == 'Opera' && $version <= 18){
            $support_webp = false ;
        }

        return $support_webp ;

    }
}

if (!function_exists('checkAndReplaceWebpImage')) {
    function checkAndReplaceWebpImage($value,$type){
        $file_name = str_replace('.webp','.jpg',$value) ;
        $directory = env('pathimages','public/uploads').'/'.$type.'/original';
        $file = $directory . '/' . $file_name;
        if (\File::exists($file)) {
            $value = $file_name ;
        }else{
            $file_name = str_replace('.webp','.jpeg',$value) ;
            $file = $directory . '/' . $file_name;
            if (\File::exists($file)) {
                $value = $file_name ;
            }else{
                $file_name = str_replace('.webp','.png',$value) ;
                $file = $directory . '/' . $file_name;
                if (\File::exists($file)) {
                    $value = $file_name ;
                }
            }
        }
        return $value ;
    }
}

/**
 * Get static Info by it's key
 */
if (!function_exists('getInfoByKey')) {
    function getInfoByKey($key)
    {
        // return Info::where('info_key', $key)->value('info_value');
        $infos = Info::join('info_translations', 'infos.infos_id', 'info_translations.infos_id')
            ->where('infos.infos_key', $key)
            ->first();

        return $infos;
    }
}
/**
 * Get MetaTag by Page key
 */
if (!function_exists('getMetaByKey')) {
    function getMetaByKey($key)
    {

        $meta = MetaTag::where('metatags_page', $key)
            ->first();

        return $meta;
    }
}
if (!function_exists('getCategoryParentChilds')) {

    $categs = array();
    function getCategoryParentChilds($category)
    {
        // To Access $deps varable each time calling Function
        global $categs;

        // Get Category Parent
        $categoryParent = $category->parent;

        if($categoryParent) {
            // Save Child title
            $categs[] = $category->categories_name;

            // Recursion function
            return getCategoryParentChilds($categoryParent);

        } else {
            // Save Final title
            $categs[] = $category->categories_name;
        }

        $result = array_reverse($categs);

        // Reinitialize Var
        $GLOBALS['categs'] = array();

        return $result;

    }
}
if (!function_exists('distance')) {
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

/**
 * Make Slug for title
 */
function make_slug($string = null, $separator = "-") {
    if (is_null($string)) {
        return "";
    }

    // Remove spaces from the beginning and from the end of the string
    $string = trim($string);

    // Lower case everything
    // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
    $string = mb_strtolower($string, "UTF-8");;

    // Make alphanumeric (removes all other characters)
    // this makes the string safe especially when used as a part of a URL
    // this keeps latin characters and arabic charactrs as well
     $string = preg_replace("/[^a-z0-9_\s\-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

    // Remove multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);

    // Convert whitespaces and underscore to the given separator
    $string = preg_replace("/[\s_]/", $separator, $string);
    return $string;
}
/**
 * custom functio to return slug from table
 */
if (!function_exists('getSlugByKey')) {
    function getSlugByKey($slugs_key)
    {
        $currentLanguage = app()->getLocale();

        $slug = Slug::join('slug_translations', 'slugs.slugs_id', 'slug_translations.slugs_id')
                            ->where('slugs.slugs_key', $slugs_key)
                            ->where('slug_translations.languages_code', $currentLanguage)->first();
        return $slug->slugs_title;
    }
}
/**
 * custom functio to return slug based on Language
 */
if (!function_exists('getSlugByKeyWithLang')) {
    function getSlugByKeyWithLang($slugs_key, $lang)
    {

        $slug = DB::table('slugs')->join('slug_translations', 'slugs.slugs_id', 'slug_translations.slugs_id')
                            ->where('slugs.slugs_key', $slugs_key)
                            ->where('slug_translations.languages_code', $lang)->first();
        // dd($slugs_key);

        return $slug->slugs_title;
    }
}
function sendNotification( $token, $title, $message,$data)
{
    $notification = new SendNotification();
    $notification->setToken($token)
        ->setData(array('click_action' =>  'FLUTTER_NOTIFICATION_CLICK','type'=>'wallet','data'=>$data))
        ->setSubject($title)
        ->setText($message)
        ->sendToAndroid();
}

function replceArabicChar($search){
    $stringArrays  = [] ;
    $resultArray = explode(" ", $search);
    foreach($resultArray as $string){
        array_push($stringArrays,$string );
        $chars = ['أ','ا','آ','إ','ء'] ;
        $result = replceAlphabetChars($string , $chars) ;
        foreach($stringArrays as $str){
            $chars = ['أ','ا','آ','إ','ء'] ;
            $result = replceAlphabetChars($str , $chars) ;
            $stringArrays = array_merge($stringArrays,$result );
            $stringArrays = array_unique($stringArrays);
        }
        foreach($stringArrays as $str){
            $chars = ['ي','ى','ئ'] ;
            $result = replceAlphabetChars($str , $chars) ;
            $stringArrays = array_merge($stringArrays,$result );
        }
        foreach($stringArrays as $str){
            $chars = ['ة','ه','ھ'] ;
            $result = replceAlphabetChars($str , $chars) ;
            $stringArrays = array_merge($stringArrays,$result );
        }
        foreach($stringArrays as $str){
            $chars = ['و','ؤ'] ;
            $result = replceAlphabetChars($str , $chars) ;
            $stringArrays = array_merge($stringArrays,$result );
        }
    }
    $stringArrays = array_unique($stringArrays);
    return $stringArrays ;
}

function replceAlphabetChars($string , $chars){
    $stringArrays = [];
    foreach($chars as $char){
        $pos = strpos($string, $char) ;

        if($pos !== false  ){

            $result = replceChar($string,$char,$chars,$pos) ;
            $stringArrays = array_merge($stringArrays,$result );
            // dd($stringArrays) ;
            do{
                $pos = strpos($string, $char,$pos+1) ;
                // dd($pos) ;
                if($pos !== false  ){
                    $result = replceChar($string,$char,$chars,$pos) ;
                    $stringArrays = array_merge($stringArrays,$result );
                }

            }while($pos !== false) ;
        }
    }
    // dd($stringArrays);
    // dd(array_unique($stringArrays)) ;
    return array_unique($stringArrays) ;
}

function replceChar($string,$char,$chars,$pos){
    $stringArrays = [];
    foreach($chars as $chr){
        // $new_string =  str_replace($char,$chr,$string);
        // array_push($stringArrays,$new_string );
        if($pos == 0  || $pos <= strlen($string)-2){   //for apply search on first and last char only
            $new_string = substr_replace($string,$chr,$pos,2) ;
            array_push($stringArrays,$new_string );
        }
    }
    return $stringArrays ;
}
?>

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        /**
     * Search in tables for index page
     * @param  object $query table's query
     * @param  array  $arr   search roles
     * @return query after search
     */
    public function searchIndex($query, array $arr)
    {
        foreach ($arr as $key => $value) {

            if (!empty($value[0]) || $value[0] == '0') {
                if ($value[1] == 'like') {
                    $query->where($key, $value[1], '%'. $value[0] . '%');
                } elseif ($value[1] == 'date') {
                    $query->whereDate($key, '=', $value[0]);
                } elseif ($value[1] == 'between') {
                    if (!empty($value[0][0]) && !empty($value[0][1])) {
                        $query->whereBetween($key, [$value[0][0], $value[0][1]]);
                    }
                } elseif ($value[1] == 'in') {
                    $query->whereIn($key, $value[0]);
                } else {
                    $query->where($key, $value[1], $value[0]);
                }
            }
        }

        return $query;
    }

    /**
     * make slug for all languages
     */
    public function makeSlug($string = null, $separator = "-") {
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
        $string = preg_replace("/[^a-z0-9_\s-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]/u", "", $string);

        // Remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        // Convert whitespaces and underscore to the given separator
        $string = preg_replace("/[\s_]/", $separator, $string);
        return $string;
    }

    /**
     * Validate Data and send errors messages as array
     * @param  Order $order
     * @return [type]           [description]
     */
    public function validateData($data, $rules)
    {
        $messages = null;
        //check the validator true or not
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            // Get Messages
            $messages = $validator->messages()->all();
        }

        return $messages;
    }

}

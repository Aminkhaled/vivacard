<?php

namespace App\Http\Controllers\Api\V001;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Traits\SendNotification;
use Modules\General\Models\Setting;
use Modules\General\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Auth ;
class ApiController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * perPage value
     * @var integer
     */
    public $perPage;
    public $langs;
    public $locales;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $perPage = 10;
        $this->perPage = $perPage;
        $this->langs = Language::active()->get();
        $this->locales = $this->langs->pluck('locale')->toArray();
    }

    protected function send_mesage_mshastra($countryCode,$phone,$msg){

        $url ="https://mshastra.com/sendurlcomma.aspx?user=".env('mshastra_user')."&pwd=".env('mshastra_pwd')."&senderid=".env('mshastra_senderid')."&mobileno=".$phone."&msgtext=".$msg."&CountryCode=".$countryCode ;
        // dd($url);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
        return  $curl_scraped_page;

    }

    function sendNotification( $token, $title, $message,$data,$type=null)
    {
        $notification = new SendNotification();
        $notification->setToken($token)
            ->setData(array('click_action' =>  'FLUTTER_NOTIFICATION_CLICK','type'=>$type,'data'=>$data))
            ->setSubject($title)
            ->setText($message)
            ->sendToAndroid();
    }

    /**
     * Handle language for multilanguages table.
     *
     * @param  string $returned which returned data
     * @return [type]           [description]
     */
    public function multiLang($returned='languages')
    {
        $languages = auth('api')->user()->langs;
        if ($returned == 'languages') {
            return $languages;
        } elseif ($returned == 'activeLang') {
            return $languages[0]->languages_code;
        } elseif ($returned == 'moreLang') {
            return count($languages) > 1 ? true : false;
        }
    }

    /**
     * Query in multi-languages table.
     *
     * @param  string $table_1          table_1 name
     * @param  string $table_id         table_1 id
     * @param  string $table_1_position table_1 position
     * @param  string $table_2          table_2m name
     * @param  string $per_page         number of records per page
     * @return collection of recored with translations
     */
    public function multiLangQuery($table_1, $table_id,$table_1_position, $table_2, $per_page=null)
    {
        $query = DB::table($table_1)->join( $table_2,  $table_1. '.' .$table_id, '=',  $table_2. '.' .$table_id)
                ->join('languages',  'languages.languages_code', '=', $table_2.'.languages_code')
                ->orderBy($table_1. '.' .$table_1_position)
                ->orderBy('languages.languages_position');

        $DB = $this->perPage($query, $per_page);

        return $DB;
    }

    /**
     * search in multi-languages table.
     *
     * @param  string $table_1          table_1 name
     * @param  string $table_id         table_1 id
     * @param  string $table_1_position table_1 position
     * @param  string $table_2          table_2m name
     * @return collection of recored with translations
     */
    public function multiLangQuerySearch($table_1, $table_id,$table_1_position, $table_2)
    {
        $DB = DB::table($table_1)->join( $table_2,  $table_1. '.' .$table_id, '=',  $table_2. '.' .$table_id)
                ->join('languages',  'languages.languages_code', '=', $table_2.'.languages_code')
                ->orderBy($table_1. '.' .$table_1_position)
                ->orderBy('languages.languages_position');

        return $DB;
    }


    /**
     * Get Pagination Count for Auth Acount
     *
     * @param  string $returned which returned data
     * @return [type]           [description]
     */
    public function perPage()
    {
        $settings_pagination_count = Setting::first()->settings_pagination_count ;
        if($settings_pagination_count) {
            return $settings_pagination_count;
        } else {
            return 10;
        }
    }

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
                    $query->where($key, $value[1], '%'. trim($value[0]) . '%');
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

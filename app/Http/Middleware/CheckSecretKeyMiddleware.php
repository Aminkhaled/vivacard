<?php

namespace App\Http\Middleware;

use App\Http\Traits\JsonResponseTrait;
use Closure;
use Illuminate\Support\Facades\Cache;
use Modules\Main\Models\Hospital;
use Stevebauman\Location\Facades\Location;
use App\Models\Main\City;

class CheckSecretKeyMiddleware
{
    use JsonResponseTrait;

    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        // $ip = '197.47.58.130';
        $currentUserInfo = Location::get($ip);
        if($currentUserInfo){
            $city = City::where('name','like','%'.$currentUserInfo->cityName.'%')->first();
            if(isset(getallheaders()['secret_key']) && $city ) {
                $hospital = Hospital::where('hospitals_secret_key',getallheaders()['secret_key'])->where('hospitals_static_ip',$request->ip())->where('cities_id',$city->cities_id)->first();
                if($hospital){
                    return $next($request);
                }
            }
        }

        $message = 'invalid secret key';
        $data = [
            'image_rtl' =>   null,
            'image_ltr' =>   null,
        ];

        return $this->jsonResponse(401, $message, [$message], $data);




    }
}

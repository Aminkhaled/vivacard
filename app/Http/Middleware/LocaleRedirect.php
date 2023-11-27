<?php

namespace App\Http\Middleware;
use Auth ;
use Closure;
use Modules\General\Models\Language;

class LocaleRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // session_start();

        if ($request->wantsJson()) {
            return $next($request);
        } else {
            $langs = Language::active()->pluck('locale')->toArray();
            $default = getSettingByKey('website_lang');
            $locale = $request->segment(1);

            if (in_array($locale, $langs)) {
                $_SESSION['localeCode'] = $locale;
                $previous_url = url()->previous();
                // $previous_url = $request->fullUrl();
                // dd($previous_url) ;
                $previous_url = str_replace($request->root(), '', $previous_url);
                return $next($request);

            } else {
                if (isset($_SESSION['localeCode'])) {
                    if (in_array($_SESSION['localeCode'], $langs)) {
                        $lang = $_SESSION['localeCode'];
                    } else {
                        $lang = $default;
                    }
                } else {
                    $_SESSION['localeCode'] = $default;
                    $lang = $default;
                }

                $newUrl = str_replace(env('APP_URL'), env('APP_URL').'/'. $lang, $request->fullUrl());
                return redirect($newUrl);
            }
        }
    }
}

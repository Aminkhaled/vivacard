<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Artisan;
use Modules\General\Models\Language;
use Modules\General\Models\Info;
use Modules\General\Models\Setting;

use Jenssegers\Agent\Agent;
use auth ;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        if(Schema::hasTable('languages')){

            $langs = Language::active()->get();
            if(sizeof($langs) > 0){

                $websiteLang = Setting::where('settings_key', 'website_lang')->value('settings_value');
                if($websiteLang ){

                    $locales = $langs->pluck('locale')->toArray();
                    $default = $locales[0];
                    $localeSegment = request()->segment(1);
                    if (in_array($localeSegment, $locales)) {
                        app()->setLocale($localeSegment);
                    } else {
                        app()->setLocale($websiteLang);
                    }
    
                    $segment = request()->segment(3);
                    $urlQuery = request()->query();
                    // Get current Language
                    $locale = app()->getLocale();
               
                    // Get Language Direction
                    $dir = $langs->firstWhere('locale', $locale)->dir;
    
                    // dd( $locale ) ;
    
                    /**
                     * Check if Website in  [ Maintenance Mode ] or Not
                     */
                    $websiteStatus = Setting::where('settings_key', 'website_status')->value('settings_value');
                    // if ($websiteStatus == '0') {
                    //     Artisan::call('down');
                    // } else {
                    //     Artisan::call('up');
                    // }
                    $agent = new Agent();
    
                    view()->share(compact('segment','langs','websiteStatus','agent','locale','dir'));
                }
            }
        }


    }
}

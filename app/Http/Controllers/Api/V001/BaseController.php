<?php

namespace App\Http\Controllers\Api\V001;
use App\Mail\AddComment;
use Modules\General\Models\Info;
use Modules\General\Models\ContactUs;
use Modules\General\Models\Contact;
use Modules\General\Models\Setting;
use Modules\General\Models\Language;
use Modules\Main\Models\Country;
use Modules\Main\Models\Customer;
use Modules\Main\Models\Package;
use Modules\Main\Models\CouponFav;
use Modules\Main\Models\CouponEffectiveness;
use Modules\Main\Models\CustomerPackage;
use Modules\Main\Models\CustomerPackageTranslation;
use Illuminate\Http\Request;
use App\Http\Traits\JsonResponseTrait;
use App\Http\Controllers\Api\V001\ApiController;
use Carbon\Carbon ;
use DB ;
class BaseController extends ApiController
{
    use JsonResponseTrait;

    public function __construct()
    {
        parent::__construct();
    }


    public function initial(Request $request){

        $langs = Language::active()->select('name','locale','dir')->get();
        $settings = Setting::select('settings_key','settings_value')->get();
        $countries = DB::table('countries')->where('countries_status','1')->orderBy('countries_position')
        ->join('country_translations','countries.countries_id','country_translations.countries_id')
        ->where('locale',app()->getLocale())
        ->select('countries.countries_id','countries_image','countries_name')->get();
        return $this->jsonResponse(200,'Data Returned Successfully', null, compact('langs','settings','countries'));
    }

    public function infos(Request $request){
        $infos =  DB::table('infos')->join('info_translations','infos.infos_id','info_translations.infos_id')
        ->where('locale',app()->getLocale())->select('infos_key','infos_title','infos_desc')->get();

        return $this->jsonResponse(200,'Data Returned Successfully', null, compact('infos'));
    }

    public function contacts(Request $request){
        $contacts =  DB::table('contacts')->join('contact_translations','contacts.contacts_id','contact_translations.contacts_id')
               ->where('locale',app()->getLocale())->select('contacts_mobiles as contacts_phone','contacts_whatsapp','contacts_facebook','contacts_twitter','contacts_instagram','contacts_snapchat','contacts_youtube','contacts_email','contacts_address','contacts_text')->first();
        if($contacts){
            $contacts->contacts_phone = '+'.env('country_code','966').$contacts->contacts_phone ;
            $contacts->contacts_whatsapp = '+'.env('country_code','966').$contacts->contacts_whatsapp ;
        }
        return $this->jsonResponse(200,'Data Returned Successfully', null, compact('contacts'));
    }

    public function faqs(Request $request){
        $faqs  =  DB::table('faqs')->join('faq_translations','faqs.faqs_id','faq_translations.faqs_id')
        ->where('locale',app()->getLocale())->where('faqs_status','1')->orderBy('faqs_position','asc')
        ->select('faq_translations.faqs_question','faq_translations.faqs_answer')->get();
        return $this->jsonResponse(200,'Data Returned Successfully', null, compact('faqs'));
    }

    public function dailyOffers(Request $request){
        $query  =  DB::table('daily_offers')
        ->join('daily_offer_translations','daily_offers.daily_offers_id','daily_offer_translations.daily_offers_id')
        ->join('stores','daily_offers.stores_id','stores.stores_id')
        ->join('store_translations','stores.stores_id','store_translations.stores_id')
        ->where('daily_offer_translations.locale',app()->getLocale())
        ->where('store_translations.locale',app()->getLocale())
        ->where('daily_offers_status','1')->orderBy('daily_offers_position','asc')
        ->select('daily_offers_name','daily_offers_code','daily_offers_image','daily_offers_url','daily_offers_price','daily_offers_price_before_sale','stores_name','stores_logo','stores.stores_id');

        $pagination = $query->paginate($this->perPage)->toArray();

        // Get Pagination Data in Array Separately
        $data = $pagination['data'];
        // Remove From Source
        unset($pagination['data']);

        // Assign Data to new Variable
        $dailyOffers = $data;

        return $this->jsonResponse(200,'Data Returned Successfully', null, compact('dailyOffers','pagination'));
    }

    public function getAdvertisementsQuery(){
        return DB::table('advertisements')
        ->join('advertisement_translations','advertisements.advertisements_id','advertisement_translations.advertisements_id')
        ->where('locale',app()->getLocale())->where('advertisements_status','1')
        ->select('advertisements.advertisements_id','advertisements_web_img','advertisements_phone_img','advertisements_url','advertisements_link_value')->orderBy('advertisements_position', 'asc')->orderBy('advertisements.advertisements_id','asc');
    }
    public function advertisements(Request $request){
        $home_banners = $this->getAdvertisementsQuery()->where('advertisements_view_page','home_banner')->get();
        $special_coupons = $this->getAdvertisementsQuery()->where('advertisements_view_page','offers_banner')->get();
        $home_popups = $this->getAdvertisementsQuery()->where('advertisements_view_page','home_popup')->get();

        return $this->jsonResponse(200,'Data Returned Successfully', null, compact('home_banners','special_coupons','home_popups'));
    }

    public function getCouponsQuery($customer ){
        
        return  DB::table('coupons')
        ->join('coupon_translations','coupons.coupons_id','coupon_translations.coupons_id')
        ->join('stores','coupons.stores_id','stores.stores_id')
        // ->rightJoin('coupon_favs','coupons.coupons_id','coupon_favs.coupons_id')
        // ->rightJoin('coupon_effectiveness','coupons.coupons_id','coupon_effectiveness.coupons_id')
        ->join('store_translations','stores.stores_id','store_translations.stores_id')
        ->where('coupon_translations.locale',app()->getLocale())->where('store_translations.locale',app()->getLocale())->where('coupons_status','1')
        ->select('coupons.coupons_id','coupons_image','coupons_code','coupons_available','coupons_name','coupons_long_name','coupons_desc','coupons_offers_desc','stores.stores_id','stores_name','stores_logo','stores_link','coupon_favs.coupon_favs_id','coupon_effectiveness.coupon_effectiveness_status')->orderBy('coupons_position', 'asc')->orderBy('coupons.coupons_id','asc')
        ->leftJoin('coupon_favs', function($join) use($customer){
            $join->on('coupons.coupons_id', '=', 'coupon_favs.coupons_id');
            if($customer){
                $join->where('coupon_favs.customers_id',$customer->customers_id);
            }else{
                $join->where('coupon_favs.customers_id','00000');
            }
        })
        ->leftJoin('coupon_effectiveness', function($join) use($customer){
            $join->on('coupons.coupons_id', '=', 'coupon_effectiveness.coupons_id');
            if($customer){
                $join->where('coupon_effectiveness.customers_id',$customer->customers_id);
            }else{
                $join->where('coupon_effectiveness.customers_id','00000');
            }
        })
        ;
    }
    public function getParentCategoriesQuery(){
        return  DB::table('categories')
        ->join('category_translations','categories.categories_id','category_translations.categories_id')
        ->where('locale',app()->getLocale())->where('categories_status','1')->where('categories_parent_id',null)
        ->select('categories.categories_id','categories_name','categories_image')->orderBy('categories_position', 'asc')->orderBy('categories.categories_id','asc');

    }
    public function getSubCategoriesQuery($categories_id){
        return  DB::table('categories')
        ->join('category_translations','categories.categories_id','category_translations.categories_id')
        ->where('locale',app()->getLocale())->where('categories_status','1')->where('categories_parent_id',$categories_id)
        ->select('categories.categories_id','categories_name','categories_image')->orderBy('categories_position', 'asc')->orderBy('categories.categories_id','asc');

    }
    
    public function getStoresQuery(){
        return DB::table('stores')
        ->join('store_translations','stores.stores_id','store_translations.stores_id')
        ->where('locale',app()->getLocale())->where('stores_status','1')
        ->select('stores.stores_id','stores_name','stores_logo','stores_link','stores_desc')->orderBy('stores_position', 'asc')->orderBy('stores.stores_id','asc');
    }
    
    public function home(Request $request){
        $customer = $request->user('customer');
        $home_banners = $this->getAdvertisementsQuery()->where('advertisements_view_page','home_banner')->get();
        $special_coupons = $this->getAdvertisementsQuery()->where('advertisements_view_page','home_offers')->get();
        $home_popups = $this->getAdvertisementsQuery()->where('advertisements_view_page','home_popup')->get();

        foreach($home_banners as $key => $home_banner){
            if($home_banner->advertisements_link_value != null ){
                $coupon =  $this->getCouponsQuery($customer)->where('coupons.coupons_id',$home_banner->advertisements_link_value)->first();
                $home_banner->coupon = $coupon ;
                $home_banners[$key] = $home_banner ;
            }
        }

        foreach($special_coupons as $key => $special_coupon){
            if($special_coupon->advertisements_link_value != null ){
                $coupon =  $this->getCouponsQuery($customer)->where('coupons.coupons_id',$special_coupon->advertisements_link_value)->first();
                $special_coupon->coupon = $coupon ;
                $special_coupons[$key] = $special_coupon ;
            }
        }

        $couponsQuery =  $this->getCouponsQuery($customer)->where('coupons_is_special','1');
        if($request->countries_id){
            $couponsQuery = $couponsQuery->join('coupon_countries','coupons.coupons_id','coupon_countries.coupons_id')->where('countries_id',$request->countries_id);
        }
        $homeCoupons = $couponsQuery->limit(8)->get();
        $main_categories =  $this->getParentCategoriesQuery()->get();
        $stores =  $this->getStoresQuery()->get();

        return $this->jsonResponse(200,'Data Returned Successfully', null, compact('home_banners','special_coupons','home_popups','homeCoupons','main_categories','stores'));
    }

    public function coupons(Request $request)
    {
        $checkDataValid =  $this->validateData($request->all(), [
            'categories_id' => 'nullable',
            'stores_id' => 'nullable',
            'categories_id' => 'nullable',
            'search_text' => 'nullable',
        ]);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }
        $customer = $request->user('customer');
        $query =  $this->getCouponsQuery($customer);
         
        if($request->categories_id){
            $query = $query->join('coupon_categories','coupons.coupons_id','coupon_categories.coupons_id')->where('categories_id',$request->categories_id);
            $categories =  $this->getSubCategoriesQuery($request->categories_id)->get();
        }else{
            $categories =  $this->getParentCategoriesQuery()->get();
        }
        if($request->countries_id){
            $query = $query->join('coupon_countries','coupons.coupons_id','coupon_countries.coupons_id')->where('countries_id',$request->countries_id);
        }
        if($request->stores_id){
            $query = $query->where('coupons.stores_id',$request->stores_id);
        }
        if($request->search_text){
            $search = $request->search_text ;
            $query = $query->where(function($que) use($search) {
                $que->where('coupons_code','like','%'.$search.'%')
                ->orWhere('coupons_name','like','%'.$search.'%')
                ->orWhere('coupons_long_name','like','%'.$search.'%')
                ->orWhere('coupons_desc','like','%'.$search.'%')
                ->orWhere('stores_name','like','%'.$search.'%');
            });
    
            
            
        }
        
        $pagination = $query->paginate($this->perPage)->toArray();

        // Get Pagination Data in Array Separately
        $data = $pagination['data'];
        // Remove From Source
        unset($pagination['data']);

        // Assign Data to new Variable
        $coupons = $data;
        
        $response = [
            'coupons' => $coupons,
            'categories' => $categories,
            'pagination' => $pagination,
        ];
        return $this->jsonResponse(200, 'coupons Data Returned Successfully', null, $response);

    }

    public function stores(Request $request)
    {
        $query =  $this->getStoresQuery();
         
        $pagination = $query->paginate($this->perPage)->toArray();

        // Get Pagination Data in Array Separately
        $data = $pagination['data'];
        // Remove From Source
        unset($pagination['data']);

        // Assign Data to new Variable
        $stores = $data;
        
        $response = [
            'stores' => $stores,
            'pagination' => $pagination
        ];
        return $this->jsonResponse(200, 'stores Data Returned Successfully', null, $response);

    }
 
    public function couponFavorite(Request $request)
    {
        
        $checkDataValid =  $this->validateData($request->all(), [
            'coupons_id' => 'required',
        ]);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }
        $is_fav = 0 ;
        if($request->user('customer')){
            $customer = $request->user('customer') ;
            $coupon_fav = CouponFav::where('customers_id',$customer->customers_id)->where('coupons_id',$request->coupons_id)->first() ;
            if($coupon_fav){
                $coupon_fav->delete();
            }else{
                $coupon_fav = new CouponFav; 
                $coupon_fav->customers_id = $customer->customers_id;
                $coupon_fav->coupons_id = $request->coupons_id;
                $coupon_fav->save();
                $is_fav = 1 ;
            }
        }

        return $this->jsonResponse(200, 'save successfully', null, compact('is_fav'));

    }

    public function couponActiveStatus(Request $request)
    {
        
        $checkDataValid =  $this->validateData($request->all(), [
            'coupons_id' => 'required',
            'status'    => 'required|in:0,1'
        ]);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }
        $coupon_effectiveness_status = 0 ;
        if($request->user('customer')){
            $customer = $request->user('customer') ;
            $coupon_effective = CouponEffectiveness::where('customers_id',$customer->customers_id)->where('coupons_id',$request->coupons_id)->first() ;
            if($coupon_effective){
                $coupon_effective->coupon_effectiveness_status = $request->status;
                $coupon_effective->save();
            }else{
                $coupon_effective = new CouponEffectiveness; 
                $coupon_effective->customers_id = $customer->customers_id;
                $coupon_effective->coupons_id = $request->coupons_id;
                $coupon_effective->coupon_effectiveness_status = $request->status;
                $coupon_effective->save();
            }
            $coupon_effectiveness_status = $request->status ;
        }

        return $this->jsonResponse(200, 'save successfully', null, compact('coupon_effectiveness_status'));

    }

    public function favoritesCoupons(Request $request)
    {
        $customer = $request->user('customer');
        $query =  $this->getCouponsQuery($customer);
        $coupons_ids = CouponFav::where('customers_id',$customer->customers_id)->get()->pluck('coupons_id') ;

        $coupons = $query->whereIn('coupons.coupons_id',$coupons_ids)->get();
        return $this->jsonResponse(200, 'coupons Data Returned Successfully', null, compact('coupons'));
    }
    
    /**
     * postContact
     *
     * @param  Request $request
     * @return json
     */
    public function postContact(Request $request)
    {

        $checkDataValid =  $this->validateData($request->all(), [
            'contact_us_name' => 'required|string|max:200',
            'contact_us_phone' => 'required|max:30',
            'contact_us_message' => 'required',
        ]);
        if ($checkDataValid) {
            return $this->jsonResponse(422, __('general::lang.wrongData'), $checkDataValid, null);
        }

        $request['contact_us_status']  =  '0';

        if($request->user('customer')){
            $customer = Customer::find($request->user('customer')->customers_id) ;
            $request['customers_id']     = $customer->customers_id ;
            $request['contact_us_email'] =  $customer->customers_email;
        }

        $contact = ContactUs::create($request->all());

        return $this->jsonResponse(200, __('general::lang.postContactSent'), null, compact('contact'));

    }

}

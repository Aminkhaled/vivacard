<?php
namespace Modules\Main\Imports;

use Modules\Main\Models\Coupon;
use Modules\Main\Models\CouponTranslation;
use Modules\Main\Models\Store;
use Modules\Main\Models\Offer;
use Modules\Main\Models\Category;
use Modules\Main\Models\Country;
use Modules\General\Models\Language;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMappedCells	;
// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
class CouponsImport implements ToCollection ,WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.coupons_code' => 'required',
            '*.stores_code'       => 'required|exists:mysql.stores,stores_code',
            '*.offers_code'       => 'required|exists:mysql.offers,offers_id',
            '*.coupons_available' => 'required|in:0,1',
            '*.coupons_is_special' => 'required|in:0,1',
            '*.coupons_position' => 'required',
            '*.coupons_status' => 'required|in:0,1',
            '*.coupons_name_ar' => 'required',
            '*.coupons_name_en' => 'required',
            // '*.coupons_long_name_ar' => 'required',
            // '*.coupons_long_name_en' => 'required',
            // '*.coupons_desc_ar' => 'required',
            // '*.coupons_desc_en' => 'required',
            // '*.coupons_offers_desc_ar' => 'required',
            // '*.coupons_offers_desc_en' => 'required',


        ],['*.coupons_code.regex'=>__('validation.SpaceNotAllowedForCode')])->validate();

        // dd($rows) ;
        foreach($rows as $row) {
       
             $coupon = Coupon::where('coupons_code',$row['coupons_code'])->first();
             if(!$coupon){
                $coupon = new Coupon ;
             }
            $coupon->coupons_code             = $row['coupons_code'] ;
            $coupon->coupons_image            = $row['coupons_image'] ;
            $coupon->coupons_available        = (string)$row['coupons_available'] ;
            $coupon->coupons_is_special       = (string)$row['coupons_is_special'] ;
            $coupon->coupons_position         = $row['coupons_position'] ;
            $coupon->coupons_status           = (string)$row['coupons_status'] ;
            $coupon->offers_id                = $row['offers_code']  ;
            if(isset($row['stores_code']) && $row['stores_code'] != ''){
                $store = Store::where('stores_code',$row['stores_code'])->first();
                if($store){
                    $coupon->stores_id = $store->stores_id  ;
                }
            } 
 
            $coupon->save() ;

            if(isset($row['categories_code']) && is_array(explode(',',$row['categories_code'])) ){
                $categories_codes = explode(',',$row['categories_code']) ;
                $categories_ids = Category::where('categories_code',$categories_codes)->get()->pluck('categories_id');
                $coupon->categories()->sync($categories_ids) ;
            }

            if(isset($row['countries_code']) && is_array(explode(',',$row['countries_code'])) ){
                $countries_codes = explode(',',$row['countries_code']) ;
                $countries_ids = Country::where('countries_code',$countries_codes)->get()->pluck('countries_id');
                $coupon->countries()->sync($countries_ids) ;
            }
            
            $langs = Language::active()->get();
            foreach($langs as $lang){
                if(isset($row['coupons_name_'.$lang->locale])){
                    $couponTranslation = CouponTranslation::where('coupons_id',$coupon->coupons_id)->where('locale',$lang->locale)->first();
                    if(!$couponTranslation){
                        $couponTranslation      = new CouponTranslation ;
                    }
                    $couponTranslation->coupons_id          = $coupon->coupons_id;
                    $couponTranslation->locale              = $lang->locale;
                    $couponTranslation->coupons_name        = $row['coupons_name_'.$lang->locale] ;
                    $couponTranslation->coupons_long_name   = isset($row['coupons_long_name_'.$lang->locale]) ? $row['coupons_long_name_'.$lang->locale] : '';
                    $couponTranslation->coupons_desc        = isset($row['coupons_desc_'.$lang->locale]) ? $row['coupons_desc_'.$lang->locale] : '';
                    $couponTranslation->coupons_offers_desc = isset($row['coupons_offers_desc_'.$lang->locale]) ? $row['coupons_offers_desc_'.$lang->locale] : '';
                    $couponTranslation->save() ;
                }
            }
           
            
        }

    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
    }
    public function chunkSize(): int
    {
        return 1000;
    }
 
}

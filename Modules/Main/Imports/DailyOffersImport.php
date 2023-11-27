<?php
namespace Modules\Main\Imports;

use Modules\Main\Models\DailyOffer;
use Modules\Main\Models\DailyOfferTranslation;
use Modules\Main\Models\Store;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMappedCells	;
// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
class DailyOffersImport implements ToCollection ,WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.daily_offers_code' => 'required|regex:/^\S*$/u',
            '*.stores_code'       => 'required|exists:mysql.stores,stores_code',
            '*.daily_offers_url' => 'required|url',
            '*.daily_offers_price' => 'required|numeric',
            '*.daily_offers_price_before_sale' => 'required|numeric',
            '*.daily_offers_position' => 'required',
            '*.daily_offers_status' => 'required',
            '*.daily_offers_name_ar' => 'required',
            '*.daily_offers_name_en' => 'required',

        ],['*.daily_offers_code.regex'=>__('validation.SpaceNotAllowedForCode')])->validate();

        // dd($rows) ;
        foreach($rows as $row) {
       
             $daily_offer = DailyOffer::where('daily_offers_code',$row['daily_offers_code'])->first();
             if(!$daily_offer){
                $daily_offer = new DailyOffer ;
             }
            $daily_offer->daily_offers_code             = $row['daily_offers_code'] ;
            $daily_offer->daily_offers_image            = $row['daily_offers_image'] ;
            $daily_offer->daily_offers_url              = $row['daily_offers_url'] ;
            $daily_offer->daily_offers_price            = $row['daily_offers_price'] ;
            $daily_offer->daily_offers_price_before_sale= $row['daily_offers_price_before_sale'] ;
            $daily_offer->daily_offers_position         = $row['daily_offers_position'] ;
            $daily_offer->daily_offers_status           = (string)$row['daily_offers_status'] ;
            if(isset($row['stores_code']) && $row['stores_code'] != ''){
                $store = Store::where('stores_code',$row['stores_code'])->first();
                if($store){
                    $daily_offer->stores_id = $store->stores_id  ;
                }
            } 

            $daily_offer->save() ;

             $dailyOfferTranslation = DailyOfferTranslation::where('daily_offers_id',$daily_offer->daily_offers_id)->where('locale','ar')->first();
             if(!$dailyOfferTranslation){
                 $dailyOfferTranslation                 = new DailyOfferTranslation ;
             }
            $dailyOfferTranslation->daily_offers_id     =  $daily_offer->daily_offers_id;
            $dailyOfferTranslation->locale              =  'ar';
            $dailyOfferTranslation->daily_offers_name   =  $row['daily_offers_name_ar'] ;
            $dailyOfferTranslation->save() ;
            

             $dailyOfferTranslation = DailyOfferTranslation::where('daily_offers_id',$daily_offer->daily_offers_id)->where('locale','en')->first();
             if(!$dailyOfferTranslation){
                $dailyOfferTranslation                  = new DailyOfferTranslation ;
             }
            $dailyOfferTranslation->daily_offers_id     =  $daily_offer->daily_offers_id;
            $dailyOfferTranslation->locale              =  'en';
            $dailyOfferTranslation->daily_offers_name   =  $row['daily_offers_name_en'] ;
            $dailyOfferTranslation->save() ;
            
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

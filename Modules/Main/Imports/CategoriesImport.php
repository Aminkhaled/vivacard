<?php
namespace Modules\Main\Imports;

use Modules\Main\Models\Category;
use Modules\Main\Models\CategoryTranslation;

use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMappedCells	;
// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
class CategoriesImport implements ToCollection ,WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.categories_code' => 'required|regex:/^\S*$/u',
            '*.categories_position' => 'required',
            '*.categories_status' => 'required',
            // 'categories_parent_id' => 'required|numeric',
            '*.categories_name_ar' => 'required',
            '*.categories_name_en' => 'required',

        ],['*.categories_code.regex'=>__('validation.SpaceNotAllowedForCode')])->validate();

        // dd($rows) ;
        foreach($rows as $row) {
            // dd($row['categories_code']) ;
             $category = Category::where('categories_code',$row['categories_code'])->first();
             if(!$category){
                $category = new Category ;
             }
            $category->categories_code = $row['categories_code'] ;
            $category->categories_position = $row['categories_position'] ;
            $category->categories_status = (string)$row['categories_status'] ;
            if(isset($row['category_parent_code']) && $row['category_parent_code'] != ''){
                $maincategory = Category::where('categories_code',$row['category_parent_code'])->first();
                if($maincategory){
                    $category->categories_parent_id = $maincategory->categories_id  ;
                }else{
                    if (!$category->isRoot()) {
                        $category->makeRoot();
                    }
                }
            }else{
                if (!$category->isRoot()) {
                    $category->makeRoot();
                }
            }

             $category->save() ;

             $CategoryTranslation = CategoryTranslation::where('categories_id',$category->categories_id)->where('locale','ar')->first();
             if($CategoryTranslation){
                $CategoryTranslation->categories_id     =  $category->categories_id;
                $CategoryTranslation->locale            =  'ar';
                $CategoryTranslation->categories_name   =  $row['categories_name_ar'] ;
                $CategoryTranslation->categories_slug   =  make_slug($category->categories_code.' '.$row['categories_name_ar'] );
                $CategoryTranslation->save() ;
             }else{
                $CategoryTranslation                    = new CategoryTranslation ;
                $CategoryTranslation->categories_id     =  $category->categories_id;
                $CategoryTranslation->locale            =  'ar';
                $CategoryTranslation->categories_name   =  $row['categories_name_ar'] ;
                $CategoryTranslation->categories_slug   =  make_slug($category->categories_code.' '.$row['categories_name_ar'] );
                $CategoryTranslation->save() ;
             }

             $CategoryTranslation = CategoryTranslation::where('categories_id',$category->categories_id)->where('locale','en')->first();
             if($CategoryTranslation){
                $CategoryTranslation->categories_id =  $category->categories_id;
                $CategoryTranslation->locale =  'en';
                $CategoryTranslation->categories_name =  $row['categories_name_en'] ;
                $CategoryTranslation->categories_slug =  make_slug($category->categories_code.' '.$row['categories_name_en'] );
                $CategoryTranslation->save() ;
             }else{
                $CategoryTranslation = new CategoryTranslation ;
                $CategoryTranslation->categories_id =  $category->categories_id;
                $CategoryTranslation->locale =  'en';
                $CategoryTranslation->categories_name =  $row['categories_name_en'] ;
                $CategoryTranslation->categories_slug =  make_slug($category->categories_code.' '.$row['categories_name_en'] );
                $CategoryTranslation->save() ;
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

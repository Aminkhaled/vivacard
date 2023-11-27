<?php

namespace Modules\General\Http\Controllers\Admin;
use Modules\General\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\General\Http\Requests\AdvertisementRequest;

use Spatie\Permission\Models\Role;
use Modules\General\Models\Advertisement;
use Modules\General\Models\Language;
use Modules\Main\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB ;
class AdvertisementsController extends Controller
{
        use StorageHandle;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'advertisements_name' => [request('name'), 'like'],
            'advertisements_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Advertisement::sorted();

        $searchQuery = $this->searchIndex($query, $searchArray);
        $advertisements = $searchQuery->paginate(env('PerPage'));

        return view('general::admin.advertisements.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coupons = Coupon::active()->get();
        return view('general::admin.advertisements.create',compact('coupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdvertisementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request)
    {
        // if($request->ar['advertisements_url'] && $request->en['advertisements_url']){
        //     if( str_contains($request->ar['advertisements_url'], env('APP_URL')) ){
        //         if(str_contains($request->ar['advertisements_url'], '/en/')  ){
        //             return back()->withErrors(__('general::lang.arabicUrlInvalid'));
        //         }
        //         if(str_contains($request->en['advertisements_url'], '/ar/')  ){
        //             return back()->withErrors(__('general::lang.englishUrlInvalid'));
        //         }
        //     }
        // }
        // dd($request->all());
        $advertisement = Advertisement::create($request->all());
        if($advertisement->advertisements_view_page == 'home_popup' && $advertisement->advertisements_status == '1'){
            Advertisement::where('advertisements_view_page','home_popup')->where('advertisements_id','<>',$advertisement->advertisements_id)->update(array('advertisements_status' => '0'));
        }
        // if($request->advertisements_images){
        //     $this->storeAdvertisementImages($advertisement->advertisements_id, $request->advertisements_images);
        // }
        return redirect()->route('admin.advertisements.index')->with('status', __('general::lang.advertisementCreated'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\General\Http\Requests\AdvertisementReques  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAdvertisementImages($advertisementID, $images)
    {
        foreach ($images as $image) {
            $current_name = $this->currentName($image);

            if($current_name){
                $this->mediumImage($image, $current_name,null,400);
                $this->thumbImage($image, $current_name,100,null);
                $this->originalImage($image, $current_name); // original must be after medium and thumbnailImage to prevent move file issue
                $this->compareImageSizes($current_name);
            }
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Admin  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        return view('general::admin.advertisements.show', compact('advertisement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        $coupons = Coupon::active()->get();
        return view('general::admin.advertisements.edit', compact('advertisement','coupons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Advertisement\Http\Requests\AdvertisementRequest  $request
     * @param  \Modules\General\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        // if($request->ar['advertisements_url'] && $request->en['advertisements_url']){
        //     if( str_contains($request->ar['advertisements_url'], env('APP_URL')) ){
        //         if(str_contains($request->ar['advertisements_url'], '/en/')  ){
        //             return back()->withErrors(__('general::lang.arabicUrlInvalid'));
        //         }
        //         if(str_contains($request->en['advertisements_url'], '/ar/')  ){
        //             return back()->withErrors(__('general::lang.englishUrlInvalid'));
        //         }
        //     }
        // }
        $languages = Language::active()->get();
        foreach ($languages as $language) {

            if($request->file( $language->locale. '.advertisements_web_img')){
                $this->deleteFiles($advertisement->translate($language->locale)->advertisements_web_img) ;
            }
            if($request->file( $language->locale. '.advertisements_phone_img')){
                $this->deleteFiles($advertisement->translate($language->locale)->advertisements_phone_img) ;
            }
        }
        $advertisement->update($request->all());
        if($advertisement->advertisements_view_page == 'home_popup' && $advertisement->advertisements_status == '1'){
            Advertisement::where('advertisements_view_page','home_popup')->where('advertisements_id','<>',$advertisement->advertisements_id)->update(array('advertisements_status' => '0'));
        }

        // if($request->advertisements_images){
        //     $this->storeAdvertisementImages($advertisement->advertisements_id, $request->advertisements_images);
        // }

        return redirect()->route('admin.advertisements.index')->with('status', __('general::lang.advertisementUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();

        return back()->with('status', __('general::lang.advertisementDeleted'));
    }

    /**
     * Store images.
     *
     * @param  \Modules\General\Http\Requests\ProductReques  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'file'  =>  'required|mimes:'.env('images_types','png,jpg,jpeg,gif,webp')
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()], 422);
        }

        // Collect file info
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        // Save image in different sizes
        $this->mediumImage($file, $fileName,null,200);
        $this->thumbImage($file, $fileName,100,null);
        $this->originalImage($file, $fileName);// original must be after medium and thumbnail Image to prevent move file issue
        $this->compareImageSizes($fileName);

        return response()->json(['success'=>$fileName]);
    }

    /**
     * Store images.
     *
     * @param  \Modules\General\Http\Requests\ProductReques  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request)
    {
        // Collect file info
        $fileName = $request->filename;
        $this->deleteFiles($fileName);
        return response()->json(['msg'=> 1 ]);
        // return $fileName;
    }

    public function changeStatus($id, $status)
    {
        $advertisement = Advertisement::find($id);
        if($advertisement){
            $advertisement->advertisements_status = $status ;
            $advertisement->save();
        }
        return response(['msg' =>  __('general::lang.updatedDone')], 200);
    }
}

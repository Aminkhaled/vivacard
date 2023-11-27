<?php

namespace Modules\Main\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\CouponRequest;
use Modules\Main\Imports\CouponsImport;
use Modules\Main\Exports\CouponsExports;
use Spatie\Permission\Models\Role;
use Modules\Main\Models\Coupon;
use Modules\Main\Models\Store;
use Modules\Main\Models\Offer;
use Modules\Main\Models\Category;
use Modules\Main\Models\Country;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use File;
use DB;
use App\Jobs\ImportJob;
class CouponsController extends Controller
{

     /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( )
    {
        set_time_limit(500);
        ini_set('memory_limit', '10G');//1 GIGABYTE

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'coupon_translations.coupons_name' => [request('name'), 'like'],
            'coupons.coupons_status' => [request('status'), '='],
            'coupons.stores_id' => [request('store'), 'like'],
        ];
        request()->flash();

        $query = Coupon::orderBy('coupons.coupons_id');

        $query = Coupon::join('coupon_translations', 'coupons.coupons_id', 'coupon_translations.coupons_id')
        ->groupBy('coupons.coupons_id')
        ->sorted();

        $searchQuery = $this->searchIndex($query, $searchArray);
        if(request('form_type') && request('form_type') == 'export'){
            $coupons = $searchQuery->with('store')->get();
         
            // return new CouponsExports($coupons);
            return (new CouponsExports($coupons))->download('coupons.xlsx');
        }

        $coupons = $searchQuery->paginate(env('PerPage'));
        $stores = Store::all()->pluck('stores_name','stores_id');
        $offers = Offer::all()->pluck('offers_name','offers_id');
        $categories = Category::all()->pluck('categories_name','categories_id');
        $countries = Country::all()->pluck('countries_name','countries_id');

        return view('main::admin.coupons.index', compact('coupons','stores','offers','categories','countries'));
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(Request $request)
    {

        $coupons = [];
        return (new CouponsExports($coupons))->download('coupons.xlsx');
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file',
        ]);
        $import =new CouponsImport();
        Excel::import($import,request()->file('file'));

        // $rows = $import->getRowCount() ;
        // if(sizeof($rows) > 0){
        //     return back()->with('status', __('main::lang.importSuccessExcept'))->with('failed_errors',$rows);
        // }else{
            return back()->with('status', __('main::lang.importSuccess'));
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::all()->pluck('stores_name','stores_id');
        $offers = Offer::all()->pluck('offers_name','offers_id');
        $categories = Category::all()->pluck('categories_name','categories_id');
        $countries = Country::all()->pluck('countries_name','countries_id');
        return view('main::admin.coupons.create',compact('stores','offers','categories','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $coupon = Coupon::create($request->all());
        
        if(sizeof($request->categories) > 0){
            $coupon->categories()->sync($request->categories);
        }
        if(sizeof($request->countries) > 0){
            $coupon->countries()->sync($request->countries);
        }

        return redirect()->route('admin.coupons.index')->with('status', __('main::lang.couponCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = Coupon::find($id);
        return view('main::admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $stores = Store::all()->pluck('stores_name','stores_id');
        $offers = Offer::all()->pluck('offers_name','offers_id');
        $categories = Category::all()->pluck('categories_name','categories_id');
        $countries = Country::all()->pluck('countries_name','countries_id');
        return view('main::admin.coupons.edit', compact('coupon','stores','offers','categories','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update($request->all());
        $coupon->categories()->sync($request->categories);
        $coupon->countries()->sync($request->countries);
        return redirect()->route('admin.coupons.index')->with('status', __('main::lang.couponUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return back()->with('status', __('main::lang.couponDeleted'));
    }

    public function changeStatus($id, $status)
    {
        $coupon = Coupon::find($id);
        if($coupon){
            $coupon->coupons_status = $status ;
            $coupon->save();
        }
        return response(['msg' =>  __('main::lang.couponUpdated')], 200);
    }

}

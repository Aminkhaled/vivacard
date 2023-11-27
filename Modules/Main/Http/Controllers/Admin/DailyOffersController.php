<?php

namespace Modules\Main\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\DailyOfferRequest;
use Modules\Main\Imports\DailyOffersImport;
use Modules\Main\Exports\DailyOffersExports;
use Spatie\Permission\Models\Role;
use Modules\Main\Models\DailyOffer;
use Modules\Main\Models\Store;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use File;
use DB;
use App\Jobs\ImportJob;
class DailyOffersController extends Controller
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
            'daily_offer_translations.daily_offers_name' => [request('name'), 'like'],
            'daily_offers.daily_offers_status' => [request('status'), '='],
            'daily_offers.stores_id' => [request('store'), 'like'],
        ];
        request()->flash();

        $query = DailyOffer::orderBy('daily_offers.daily_offers_id');

        $query = DailyOffer::join('daily_offer_translations', 'daily_offers.daily_offers_id', 'daily_offer_translations.daily_offers_id')
        ->groupBy('daily_offers.daily_offers_id')
        ->sorted();

        $searchQuery = $this->searchIndex($query, $searchArray);
        if(request('form_type') && request('form_type') == 'export'){
            $daily_offers = $searchQuery->with('store')->get();
         
            // return new DailyOffersExports($daily_offers);
            return (new DailyOffersExports($daily_offers))->download('daily_offers.xlsx');
        }

        $daily_offers = $searchQuery->paginate(env('PerPage'));
        $stores = Store::all()->pluck('stores_name','stores_id');
        return view('main::admin.daily_offers.index', compact('daily_offers','stores'));
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export(Request $request)
    {

        $daily_offers = [];
        return (new DailyOffersExports($daily_offers))->download('daily_offers.xlsx');
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file',
        ]);
        $import =new DailyOffersImport();
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
        return view('main::admin.daily_offers.create',compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DailyOfferRequest $request)
    {
        $daily_offer = DailyOffer::create($request->all());
        return redirect()->route('admin.daily_offers.index')->with('status', __('main::lang.daily_offerCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\DailyOffer  $daily_offer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daily_offer = DailyOffer::find($id);
        return view('main::admin.daily_offers.show', compact('daily_offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\DailyOffer  $daily_offer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daily_offer = DailyOffer::find($id);
        $stores = Store::all()->pluck('stores_name','stores_id');
        return view('main::admin.daily_offers.edit', compact('daily_offer','stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(DailyOfferRequest $request, DailyOffer $daily_offer)
    {
        $daily_offer->update($request->all());
        return redirect()->route('admin.daily_offers.index')->with('status', __('main::lang.daily_offerUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daily_offer = DailyOffer::find($id);
        $daily_offer->delete();
        return back()->with('status', __('main::lang.daily_offerDeleted'));
    }

    public function changeStatus($id, $status)
    {
        $daily_offer = DailyOffer::find($id);
        if($daily_offer){
            $daily_offer->daily_offers_status = $status ;
            $daily_offer->save();
        }
        return response(['msg' =>  __('main::lang.daily_offerUpdated')], 200);
    }

}

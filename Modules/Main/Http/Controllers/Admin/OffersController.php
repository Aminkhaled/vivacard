<?php

namespace Modules\Main\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\OfferRequest;

use Spatie\Permission\Models\Role;
use Modules\Main\Models\Offer;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'offer_translations.offers_name'=> [request('name'), 'like'],
            'offers.offers_status'          => [request('status'), '='],
        ];
        request()->flash();

        $query = Offer::join('offer_translations', 'offers.offers_id', 'offer_translations.offers_id')
        ->groupBy('offers.offers_id');

        $searchQuery = $this->searchIndex($query, $searchArray);
        $offers = $searchQuery->paginate(env('PerPage'));

        return view('main::admin.offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main::admin.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        $offer = Offer::create($request->all());
        return redirect()->route('admin.offers.index')->with('status', __('main::lang.offerCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offer = Offer::find($id);
        return view('main::admin.offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = Offer::find($id);
        return view('main::admin.offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, Offer $offer)
    {
        $offer->update($request->all());
        return redirect()->route('admin.offers.index')->with('status', __('main::lang.offerUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $offer = Offer::find($id);
        $offer->delete();
        return back()->with('status', __('main::lang.offerDeleted'));
    }

    public function changeStatus($id, $status)
    {
        $offer = Offer::find($id);
        if($offer){
            $offer->offers_status = $status ;
            $offer->save();
        }
        return response(['msg' =>  __('main::lang.offerUpdated')], 200);
    }

}

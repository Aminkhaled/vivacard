<?php

namespace Modules\Main\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\StoreRequest;

use Spatie\Permission\Models\Role;
use Modules\Main\Models\Store;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'store_translations.stores_name'=> [request('name'), 'like'],
            'stores.stores_status'          => [request('status'), '='],
        ];
        request()->flash();

        $query = Store::join('store_translations', 'stores.stores_id', 'store_translations.stores_id')
        ->groupBy('stores.stores_id');

        $searchQuery = $this->searchIndex($query, $searchArray);
        $stores = $searchQuery->paginate(env('PerPage'));

        return view('main::admin.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main::admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $store = Store::create($request->all());
        return redirect()->route('admin.stores.index')->with('status', __('main::lang.storeCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::find($id);
        return view('main::admin.stores.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        return view('main::admin.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Store $store)
    {
        $store->update($request->all());
        return redirect()->route('admin.stores.index')->with('status', __('main::lang.storeUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $store = Store::find($id);
        $store->delete();
        return back()->with('status', __('main::lang.storeDeleted'));
    }

    public function changeStatus($id, $status)
    {
        $store = Store::find($id);
        if($store){
            $store->stores_status = $status ;
            $store->save();
        }
        return response(['msg' =>  __('main::lang.storeUpdated')], 200);
    }

}

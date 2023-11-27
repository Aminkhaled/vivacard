<?php

namespace Modules\Main\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\CityRequest;

use Spatie\Permission\Models\Role;
use Modules\Main\Models\Country;
use Modules\Main\Models\City;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'city_translations.cities_name' => [request('title'), 'like'],
            'cities.cities_status' => [request('status'), '='],
            'cities.countries_id' => [request('country'), '='],
        ];
        request()->flash();

        $query = City::join('city_translations', 'cities.cities_id', 'city_translations.cities_id')
        ->groupBy('cities.cities_id');

        $searchQuery = $this->searchIndex($query, $searchArray);
        $cities = $searchQuery->paginate(env('PerPage'));
        $countries = Country::get()->pluck('countries_name','countries_id');
        return view('main::admin.cities.index', compact('cities','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get()->pluck('countries_name','countries_id');
        return view('main::admin.cities.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $city = City::create($request->all());
        return redirect()->route('admin.cities.index')->with('status', __('main::lang.cityCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::find($id);
        return view('main::admin.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $countries = Country::get()->pluck('countries_name','countries_id');
        return view('main::admin.cities.edit', compact('city','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('admin.cities.index')->with('status', __('main::lang.cityUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();
        return back()->with('status', __('main::lang.cityDeleted'));
    }

    public function changeStatus($id, $status)
    {
        $city = City::find($id);
        if($city){
            $city->cities_status = $status ;
            $city->save();
        }
        return response(['msg' =>  __('main::lang.cityUpdated')], 200);
    }

}

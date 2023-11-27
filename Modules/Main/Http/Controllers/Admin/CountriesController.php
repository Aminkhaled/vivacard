<?php

namespace Modules\Main\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\CountryRequest;

use Spatie\Permission\Models\Role;
use Modules\Main\Models\Country;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'country_translations.countries_name' => [request('title'), 'like'],
            'countries.countries_status' => [request('status'), '='],
        ];
        request()->flash();

        $query = Country::join('country_translations', 'countries.countries_id', 'country_translations.countries_id')
        ->groupBy('countries.countries_id');

        $searchQuery = $this->searchIndex($query, $searchArray);
        $countries = $searchQuery->paginate(env('PerPage'));

        return view('main::admin.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main::admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create($request->all());
        return redirect()->route('admin.countries.index')->with('status', __('main::lang.countryCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::find($id);
        return view('main::admin.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = Country::find($id);
        return view('main::admin.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->all());
        return redirect()->route('admin.countries.index')->with('status', __('main::lang.countryUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = Country::find($id);
        $country->deleteWithFiles('countries_image'); 
        return back()->with('status', __('main::lang.countryDeleted'));
    }

    public function changeStatus($id, $status)
    {
        $country = Country::find($id);
        if($country){
            $country->countries_status = $status ;
            $country->save();
        }
        return response(['msg' =>  __('main::lang.countryUpdated')], 200);
    }

}

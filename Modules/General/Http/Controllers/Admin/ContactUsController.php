<?php

namespace Modules\General\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Modules\General\Models\ContactUs;
use Maatwebsite\Excel\Facades\Excel;
use Modules\General\Exports\ContactUsExport;
class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $searchArray = [
            'contact_us_name' => [request('name'), 'like'],
            'contact_us_type' => [request('type'), '='],
            'contact_us_status' => [request('status'), '=']
        ];
        // dd($searchArray);

        request()->flash();

        $query = ContactUs::orderBy('contact_us_id','Desc');

        $searchQuery = $this->searchIndex($query, $searchArray);

        if(request('form_type') && request('form_type') == 'export'){
            $contactus = $searchQuery->get();
            return new ContactUsExport($contactus);
        }

        $contactus = $searchQuery->paginate(env('PerPage'));

        return view('general::admin.contactus.index', compact('contactus'));
    }

    /**
     * get Count new ContactUs  .
     *
     * @return \Illuminate\Http\Response
     */
    public static  function getCountContactUs(){

        $CountContactUs = ContactUs::where('contact_us_status','0')->count('contact_us_id');
        return $CountContactUs ;
    }
    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\ContactUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contactus = ContactUs::find($id) ;
        return view('general::admin.contactus.show', compact('contactus'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\ContactUs  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contactus = ContactUs::find($id) ;
        $contactus->contact_us_status = '1' ;
        $contactus->save();

        return back()->with('status', __('general::lang.updatedDone'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\ContactUs  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contactus = ContactUs::find($id) ;
        $contactus->delete();

        return back()->with('status', __('general::lang.deletedDone'));
    }

}

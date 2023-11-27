<?php

namespace Modules\General\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\General\Http\Requests\ContactRequest;

use Modules\General\Models\Contact;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('admin.contacts.show', 1);
        $searchArray = [
            'contact_translations.contacts_address' => [request('address'), 'like'],
            'contacts.contacts_facebook' => [request('facebook'), '=']
        ];
        request()->flash();

        $query = Contact::join('contact_translations', 'contacts.contacts_id', 'contact_translations.contacts_id');

        $searchQuery = $this->searchIndex($query, $searchArray);
        $contacts = $searchQuery->groupBy('contacts.contacts_id')->paginate(env('PerPage'));
        // return $contacts ;
        return view('general::admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('general::admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\ContactReques  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        // Create New Contact
        Contact::create($request->all());

        return redirect()->route('admin.contacts.index')->with('status', __('general::lang.contactCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::first();
        request()->flash();
        return view('general::admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        request()->flash();
        // return $contact ;
        return view('general::admin.contacts.edit', compact('contact'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\ContactReques  $request
     * @param  \Modules\General\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        // Update Contact
        $contact->update($request->all());
        return redirect()->route('admin.contacts.show', 1)->with('status', __('general::lang.contactUpdated'));
        // return redirect()->route('admin.contacts.index')->with('status', __('general::lang.contactUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {

        $contact->delete();

        return back()->with('status', __('general::lang.contactDeleted'));
    }


}

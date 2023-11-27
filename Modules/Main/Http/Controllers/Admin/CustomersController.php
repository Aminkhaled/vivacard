<?php

namespace Modules\Main\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Main\Http\Requests\CustomerRequest;

use Spatie\Permission\Models\Role;
use Modules\Main\Models\Customer;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'customers_name' => [request('name'), 'like'],
            'customers_phone' => [request('phone'), 'like'],
            'customers_email' => [request('email'), 'like'],
            'customers_status' => [request('status'), '='],
        ];
        request()->flash();

        $query = Customer::orderBy('customers_id');

        $searchQuery = $this->searchIndex($query, $searchArray);
        $customers = $searchQuery->paginate(env('PerPage'));

        return view('main::admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('main::admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Main\Http\Requests\CustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->all());
        return redirect()->route('admin.customers.index')->with('status', __('main::lang.customerCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Main\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('main::admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Main\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('main::admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Main\Http\Requests\CustomerRequest  $request
     * @param  \Modules\Main\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        return redirect()->route('admin.customers.index')->with('status', __('main::lang.customerUpdated'));
    }

    public function changeStatus($id, $status)
    {
        $customer = Customer::find($id);
        if($customer){
            $customer->customers_status = $status ;
            $customer->save();
        }
        return response(['msg' =>  __('main::lang.customerUpdated')], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Main\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back()->with('status', __('main::lang.customerDeleted'));
    }
}

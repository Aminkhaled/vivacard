<?php

namespace Modules\General\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\General\Http\Requests\AdminRequest;

use Spatie\Permission\Models\Role;
use Modules\General\Models\Admin;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'name' => [request('name'), 'like'],
            'email' => [request('email'), 'like'],
            'admins_status' => [request('status'), '='],
            'admins_type' => [request('type'), 'like']
        ];
        request()->flash();

        $query = Admin::sorted();

        $authId = auth()->id();
        if ($authId != 1) {
            $query->where('admins_id', '!=', 1);
        }

        $searchQuery = $this->searchIndex($query, $searchArray);
        $admins = $searchQuery->paginate(env('PerPage'));

        return view('general::admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = Role::orderBy('id');
        $authId = auth()->id();
        if ($authId != 1) {
            $query->where('name', '!=', 'super_admin');
        }
        $roles = $query->get();

        return view('general::admin.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->all());
        $admin->syncRoles(request('roles'));

        return redirect()->route('admin.admins.index')->with('status', __('general::lang.adminCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('general::admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        $query = Role::orderBy('id');
        $authId = auth()->id();
        // return auth()->user()->admins_type ;
        if ($authId != 1) {
            $query->where('name', '!=', 'super_admin');
        }
        $roles = $query->get();

        return view('general::admin.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\AdminRequest  $request
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->update($request->all());
        $admin->syncRoles(request('roles'));
        if(auth()->user()->admins_type != 'admin' || !auth()->user()->can('show admins') ){
            return view('general::admin.admins.show', compact('admin'));
        }
        return redirect()->route('admin.admins.index')->with('status', __('general::lang.adminUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\General\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return back()->with('status', __('general::lang.adminDeleted'));
    }
}

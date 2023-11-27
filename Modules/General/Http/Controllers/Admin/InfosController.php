<?php

namespace Modules\General\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\General\Http\Requests\InfoRequest;

use Modules\General\Models\Info;

class InfosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $searchArray = [
            'infos.infos_key' => [request('key'), 'like'],
            'info_translations.infos_title' => [request('value'), 'like'],
            'infos.infos_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Info::join('info_translations', 'infos.infos_id', 'info_translations.infos_id')
        ->groupBy('infos.infos_id')
        ->sorted();
        ;
        $searchQuery = $this->searchIndex($query, $searchArray);
        $infos = $searchQuery->paginate(env('PerPage'));

        return view('general::admin.infos.index', compact('infos'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {   
        $info = Info::whereInfosKey($key)->first();
        request()->flash();
        return view('general::admin.infos.show', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit($key)
    {   
        $info = Info::whereInfosKey($key)->first();
        request()->flash();
        return view('general::admin.infos.edit', compact('info'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\InfoReques  $request
     * @param  \Modules\General\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(InfoRequest $request, Info $info)
    {
        // Update Info
        $info->update($request->all());

        return redirect()->route('admin.infos.show', [$info->infos_key, 'activeLocale' => app()->getLocale()])->with('status', __('general::lang.updatedDone'));
    }


}

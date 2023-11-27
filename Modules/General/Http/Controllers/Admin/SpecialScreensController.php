<?php

namespace Modules\General\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\General\Http\Requests\InfoRequest;

use Modules\General\Models\Info;

class SpecialScreensController extends Controller
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
        ->whereIn('infos_key',['welcome_screen1','welcome_screen2','welcome_screen3'])
        ->groupBy('infos.infos_id')
        ->sorted();

        $searchQuery = $this->searchIndex($query, $searchArray);
        $infos = $searchQuery->paginate(env('PerPage'));

        return view('general::admin.special_screens.index', compact('infos'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = Info::find($id);
        request()->flash();
        return view('general::admin.special_screens.show', compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $info = Info::find($id);
        request()->flash();
        return view('general::admin.special_screens.edit', compact('info'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\General\Http\Requests\InfoReques  $request
     * @param  \Modules\General\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(InfoRequest $request,$id)
    {
        $info = Info::find($id);
        // Update Info
        $info->update($request->all());
        return redirect()->route('admin.special_screens.index')->with('status', __('general::lang.updatedDone'));
    }


}

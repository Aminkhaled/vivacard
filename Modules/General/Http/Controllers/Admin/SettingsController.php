<?php

namespace Modules\General\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Modules\General\Models\Setting;
use Modules\General\Models\StorageHandle;
class SettingsController extends Controller
{
    use  StorageHandle;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $settings = Setting::all();

        return view('general::admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\General\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        request()->flash();
        return view('general::admin.settings.edit', compact('setting'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \Modules\General\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {

        request()->flash();
        return view('general::admin.settings.show', compact('setting'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Setting\Http\Requests\SettingRequest  $request
     * @param  \Modules\General\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {

        // dd($request->all());
        foreach ($request->all() as $key => $value) {
            if($key != "_token"){
                Setting::where('settings_key', $key)->update([
                    'settings_key'    =>  $key,
                    'settings_value'    =>  $value
                ]);
            }
        }

        return redirect()->route('admin.settings.edit')->with('status', __('general::lang.settingUpdated'));
    }

}

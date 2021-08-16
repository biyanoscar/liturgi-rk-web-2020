<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        //insert data if still blank
        if (! $setting) {
            $setting = new Setting;
            $setting->drive_link_id = '';
            $setting->save();
        }

        return $this->edit($setting);
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', [
            'setting' => $setting
        ]);
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->update($request->all());

        return redirect()->back()
            ->with('success-message', 'Setting updated successfully!');
    }
}

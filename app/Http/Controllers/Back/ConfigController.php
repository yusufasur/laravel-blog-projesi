<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::find(1);
        return view('back.config.index', compact('config'));
    }

    public function update(Request $request)
    {
        $config = Config::find(1);

        $config->title      = $request->title;
        $config->active     = $request->active;
        $config->facebook   = $request->facebook;
        $config->twitter    = $request->twitter;
        $config->linkedin   = $request->linkedin;
        $config->youtube    = $request->youtube;
        $config->github     = $request->github;
        $config->instagram  = $request->instagram;

        if ($request->hasFile('logo')) {
            $logo = \Str::slug($request->title) . '-logo.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $logo);
            $config->logo = 'uploads/' . $logo;
        }

        if ($request->hasFile('favicon')) {
            $favicon = \Str::slug($request->title) . '-favicon.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'), $favicon);
            $config->favicon = 'uploads/' . $favicon;
        }

        $config->save()
            ? toastr()->success('Ayarlar başarıyla güncellendi.')
            : toastr()->error('Ayarlar güncellenirken bir hata oluştu!');

        return back();
    }
}

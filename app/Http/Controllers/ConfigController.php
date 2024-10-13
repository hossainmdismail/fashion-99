<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Photo;

class ConfigController extends Controller
{
    //Return Value
    public static $name;
    public function index()
    {
        $request = Config::first();
        return view('backend.config.index', [
            'request' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.config.create_banner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'number'    => 'required',
            'address'   => 'required',
            'logo'      => 'required',
            'fav'       => 'required',
            'url'       => 'required',
        ]);

        if (Config::count() != 0) {
            Config::truncate();
        }

        if ($request->logo) {
            Photo::upload($request->logo, 'files/config', 'CONFIG');
        }

        if ($request->fav) {
            $this->upload($request->fav, 'files/config', 'CONFAV');
        }

        $config = new Config();
        $config->name       = $request->name;
        $config->email      = $request->email;
        $config->number     = $request->number;
        $config->url        = $request->url;
        $config->address    = $request->address;
        $config->logo       = $request->logo ? Photo::$name : 'null';
        $config->fav        = $request->fav ? self::$name : 'null';
        $config->save();
        return back()->with('succ', 'Successfully configure');
    }

    /**
     * Display the specified resource.
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Config $config)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Config $config)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'number'    => 'required',
            'address'   => 'required',
            'url'       => 'required',
        ]);

        $config->name       = $request->name;
        $config->email      = $request->email;
        $config->number     = $request->number;
        $config->url        = $request->url;
        $config->address    = $request->address;

        if ($request->logo) {
            Photo::delete('files/config', $config->logo);
            Photo::upload($request->logo, 'files/config', 'CONFIG');
            $config->logo   = Photo::$name;
        }

        if ($request->fav) {
            Photo::delete('files/config', $config->fav);
            Photo::upload($request->fav, 'files/config', 'CONFIG');
            $config->fav   = Photo::$name;
        }

        $config->save();
        return back()->with('succ', 'Successfully configure');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Config $config)
    {
        //
    }

    //Image Upload Methods
    //Pure File //Path Name // Prefix for name // size alternative
    public static function upload($file, $path, $prefix, $size = [])
    {
        if (file_exists(public_path($path))) {
            try {
                $extention = $file->getClientOriginalExtension();
                $name = $prefix . rand(1, 2000) . rand(1, 500) . '-' . date('dmy') . '.' . $extention;
                if (count($size) != 2) {
                    Image::make($file)->save(public_path($path . '/' . $name));
                } else {
                    Image::make($file)->resize($size[0], $size[1])->save(public_path($path . '/' . $name));
                }
                self::$name = $name;
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        } else {
            return false;
        }
    }
}

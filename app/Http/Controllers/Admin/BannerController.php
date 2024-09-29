<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Photo;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Banner::all();
        return view('backend.banner.index', compact('requests'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('backend.banner.create_banner', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_category'       => 'required',
            'banner_title'          => 'required',
            'banner_image'          => 'required',
            'banner_description'    => 'required',
        ]);
        Photo::upload($request->banner_image, 'files/banner', $request->banner_title, [966, 542]);
        Banner::insert([
            'banner_category'       => $request->banner_category,
            'banner_title'          => $request->banner_title,
            'banner_image'          => Photo::$name,
            'banner_description'    => $request->banner_description,
            'created_at'            => Carbon::now(),
        ]);
        return back()->with('succ', 'Banner added...');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $request = Banner::find($id);
        $categories = ProductCategory::all();
        return view('backend.banner.edit_banner', compact('request', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'banner_title'          => 'required',
            'banner_category'       => 'required',
            'banner_description'    => 'required',
        ]);
        // dd($request->banner_image);

        $banner = Banner::find($id);
        $banner->banner_category        = $request->banner_category;
        $banner->banner_title           = $request->banner_title;
        $banner->banner_description     = $request->banner_description;

        if ($request->banner_image) {
            Photo::delete('files/banner',$banner->banner_image);
            Photo::upload($request->banner_image, 'files/banner', 'BAN',[966, 542]);
            $banner->banner_image  = Photo::$name;
        }
        $banner->save();
        return redirect()->route('banner.index')->with('succ', 'Banner added...');
    }

    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        if ($banner->banner_image) {
            Photo::delete('files/banner',$banner->banner_image);
        }
        $banner->delete();
        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Photo;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create_category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name'     => 'required',
            'category_image'    => 'required',
        ]);
        Photo::upload($request->category_image, 'files/category', $request->category_name,[200,200]);
        ProductCategory::insert([
            'category_name'     => $request->category_name,
            'slugs'             => Str::slug($request->category_name),
            'category_image'    => Photo::$name,
            'seo_title'         => $request->seo_title,
            'seo_description'   => $request->seo_description,
            'seo_tags'          => $request->seo_tags,
            'created_at'        => Carbon::now(),
        ]);
        return back()->with('succ', 'Category added...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = ProductCategory::find($id);
        return view('backend.category.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $request->validate([
            'category_name' => 'required',
        ]);

        $category = ProductCategory::find($id);
        $category->category_name    = $request->category_name;
        $category->slugs            = Str::slug($request->category_name);
        $category->seo_title        = $request->seo_title;
        $category->seo_description  = $request->seo_description;
        $category->seo_tags         = $request->seo_tags;

        if ($request->category_image) {
            Photo::delete('files/category',$category->category_image);
            Photo::upload($request->category_image, 'files/category', 'CAT',[200, 200]);
            $category->category_image  = Photo::$name;
        }

        $category->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::find($id);
        if ($category->category_image) {
            Photo::delete('files/category',$category->category_image);
        }
        $category->delete();
        return back();
    }
}

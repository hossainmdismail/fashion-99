<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $theme = Theme::get();
        return view('backend.theme.index', [
            'themes' => $theme
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $theme = Theme::where('default', true)->update(['default' => false]);

        $themeUpdate = Theme::findOrFail($id);
        if ($themeUpdate) {
            $themeUpdate->default = true;
            $themeUpdate->save();
            return back()->with('succ', 'Theme active successfully');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

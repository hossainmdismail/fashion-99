<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Variation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Service::all();
        return view('backend.variation.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.variation.create_variation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'variation_name' => 'required',
        ]);
        Service::insert([
            'message'    => $request->variation_name,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('succ', 'Service added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $variation = Service::find($id);
        return view('backend.variation.edit_variatoin', compact('variation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'variation_name' => 'required',
        ]);
        Service::where('id', $id)->update([
            'message'     => $request->variation_name,
            'updated_at'  => Carbon::now(),
        ]);
        return back()->with('succ', 'Variation Updated...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Service::find($id)->delete();
        return back();
    }
}

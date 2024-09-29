<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipping;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Shipping::all();
        return view('backend.shipping.index',[
            'data' => $data
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
        $request->validate([
            'name'  => 'required|string',
            'price' => 'required|integer',
        ]);

        $shipping = new Shipping();
        $shipping->name     = $request->name;
        $shipping->price    = $request->price;
        $shipping->save();

        return back()->with('succ', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shipping $shipping)
    {
        $shipping->delete();
        return redirect()->route('shipping.index')->with('succ', 'Delete successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipping $shipping)
    {
        return view('backend.shipping.edit',[
            'shipping' => $shipping
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shipping $shipping)
    {
        $shipping->name = $request->name;
        $shipping->price = $request->price;
        $shipping->save();
        return redirect()->route('shipping.index')->with('succ', 'Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipping $shipping)
    {
        //
    }
}

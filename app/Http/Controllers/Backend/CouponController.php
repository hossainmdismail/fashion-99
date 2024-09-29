<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('backend.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $couponTypes = Coupon::TYPES;
        return view('backend.coupon.create_coupon', compact('couponTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


       // Validate the request data
     $request->validate([
        'coupon_type' => 'required',
        'coupon_code' => 'required|unique:coupons,code',
        'coupon_value' => 'required|numeric',
    ]);

    // Create a new coupon instance with the validated data
    $coupon = new Coupon();
    $coupon->type = $request->coupon_type;
    $coupon->code = $request->coupon_code;
    $coupon->value = $request->coupon_value;
    $coupon->save();

    return back()->with('success', 'Coupon created successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $couponTypes = Coupon::TYPES;
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon', compact('coupon','couponTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

       // Validate the request data
     $request->validate([
        'coupon_type' => 'required',
        'coupon_code' => 'required|unique:coupons,code',
        'coupon_value' => 'required|numeric',
    ]);
    $coupon =Coupon::find($id);
    $coupon->type = $request->coupon_type;
    $coupon->code = $request->coupon_code;
    $coupon->value = $request->coupon_value;
    $coupon->save();

    return back()->with('success', 'Coupon updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coupon::find($id)->delete();
        return redirect()->route('coupon.index')->with('success', 'Coupon deleted successfully!');
    }
}

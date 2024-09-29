<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Photo;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Admin::where('id', '!=', Auth::guard('admin')->user()->id)->get();
        return view('backend.admin.employee',[
            'employee' => $employee
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
        $validated = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|max:255',
            'number'    => 'required|max:11',
            'password'  => 'required|min:8',
        ]);
        //Pure File //Path Name // Prefix for name // size alternative
        Photo::upload($request->profile, 'files/profile', 'adminProfile');

        Admin::insert([
            'name' => $request->name,
            'profile' => Photo::$name,
            'email' => $request->email,
            'number' => $request->number,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($admin)
    {
        $employee = Admin::find($admin);
        return view('backend.admin.edit',[
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $admin)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'number' => 'required|max:11',
        ]);

        $employee = Admin::find($admin);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->number = $request->number;
        $employee->role = $request->role;
        if ($request->password != null) {
            $employee->password = $request->password;
        }
        $employee->save();
        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}

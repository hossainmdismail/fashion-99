<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required',
            'number'    => ['required', 'regex:/^01[3-9]\d{8}$/'],
            'btn'       => 'required',
        ]);

        $user->name = $request->name;
        $user->number = $request->number;

        if ($request->street != null || $request->city != null || $request->devision != null) {
            $request->validate([
                'street'    => 'required',
                'city'      => 'required',
                'devision'  => 'required',
            ]);

            $user->address = "$request->street, $request->city, $request->devision";
        }


        if ($request->btn == 2) {
            $user->is_blocked = 1;
            $user->save();
            return back()->with('succ', 'User blocked successfully');
        }

        $user->save();
        return back()->with('succ', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

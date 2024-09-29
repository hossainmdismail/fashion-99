<?php

namespace App\Http\Controllers;

use App\Models\CustomLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CustomLink::first();
        return view('backend.custom.index',[
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
        $data = CustomLink::get();
        if ($data->count() < 1) {
            $customLink = new CustomLink();
            $customLink->header = $request->header;
            $customLink->body   = $request->body;
            $customLink->footer = $request->footer;
            $customLink->save();
        }else {
            $update = $data->first();
            $update->header = $request->header;
            $update->body   = $request->body;
            $update->footer = $request->footer;
            $update->save();
        }
        return back();

    }

    /**
     * Display the specified resource.
     */
    public function show(CustomLink $customLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomLink $customLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomLink $customLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomLink $customLink)
    {
        //
    }
}

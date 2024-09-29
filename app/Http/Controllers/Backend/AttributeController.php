<?php

namespace App\Http\Controllers\Backend;

use App\Models\Inventory;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Photo;

class AttributeController extends Controller
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
        $request->validate([
            'id'            => 'required|integer',
            // 'sku'           => 'required|unique:inventories,sku',
            'color_id'      => 'required|integer',
            // 'size_id'       => 'required|integer',
            'qnt'           => 'required|integer',
            'image'         => 'required'
        ]);

        DB::beginTransaction();
        try {
            $inventory = new Inventory();
            $inventory->product_id  = $request->id;
            // $inventory->sku         = $request->sku;
            $inventory->color_id    = $request->color_id;
            $inventory->size_id     = $request->size_id;
            $inventory->qnt         = $request->qnt;
            $inventory->total_qnt   = $request->qnt;

            //Upload Photo
            Photo::upload($request->image, 'files/product', 'PRO' . $request->id, [400, 400]);
            if (Photo::$name) {
                $inventory->image   = Photo::$name;
            }
            $inventory->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('err', $th->getMessage());
        }
        return back()->with('succ', 'Attributes added succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($inventory): JsonResponse
    {
        $data = Inventory::find($inventory);
        if ($data) {
            return response()->json($data);
        } else {
            return response()->json([
                'status'     => 1,
                'message'    => 'Data not found',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $inventory)
    {
        $request->validate([
            'id'            => 'required|integer',
            'color_id'      => 'required|integer',
            // 'size_id'       => 'required|integer',
        ]);

        $attributes = Inventory::find($inventory);
        if ($attributes) {
            $attributes->color_id = $request->color_id;
            $attributes->size_id  = $request->size_id;
            $attributes->qnt      = $request->avlqnt;
            // if ($request->qnt) {
            //     $attributes->qnt = $attributes->qnt + $request->qnt;
            // }
            if ($request->has('image')) {
                //Delete Image
                Photo::delete('files/product', $attributes->image);
                //Upload Photo
                Photo::upload($request->image, 'files/product', 'PRO-UP' . $request->id, [400, 400]);
                $attributes->image = Photo::$name;
            }
            // $attributes->sp_price = $request->sp_price;
            $attributes->save();
            return back()->with('succ', 'Update successfully');
        }
        return back()->with('err', 'Attributes not found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\VendorItem;
use Illuminate\Http\Request;

class VendorItemController extends Controller
{

    public function store(Request $request)
    {
        // store Items.
        $vendorItem = new VendorItem();
        $vendorItem->restaurant_id = $request->restaurant_id;
        $vendorItem->menu_id = $request->menu_id;
        $vendorItem->name = $request->name;
        $vendorItem->description = $request->description;
        $vendorItem->price = $request->price;
        $vendorItem->save();

        return response()->json([
            'status' => (bool) $vendorItem,
            'data' => $vendorItem,
            'message' => $vendorItem ? 'Product Created!' : 'Error Creating Product',
        ]);

    }

    public function index()
    {
        //get all items
        // $vend_i = VendorItem::get();
        return response()->json(VendorItem::all(), 200);
    }

    public function show($id)
    {
        return response()->json($id, 200);
        // dd($vendorItem);
    }

    public function destroy()
    {
        $status = $vendorItem->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Food Deleted!' : 'Error Deleting',
        ]);
    }
}

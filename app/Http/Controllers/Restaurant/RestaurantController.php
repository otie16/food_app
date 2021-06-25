<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
// for restaurant to check all items added
        return response()->json(Restaurant::all(), 200);
    }

// add restaurant
    public function store(Request $request)
    {
        $restaurant = new Restaurant();
        $restaurant->user_id = $request->user_id;
        $restaurant->restaurant_name = $request->restaurant_name;
        $restaurant->location = $request->location;
        $restaurant->description = $request->description;
        $restaurant->save();

        return response()->json([
            'data' => $restaurant,
            'message' => $restaurant ? 'You sucessfully created a restaurant' : 'There was an error',
        ]);
    }

    public function destroy()
    {
        $status = $restaurant->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Restaurant Deleted!' : 'Error Deleting',

        ]);
    }
}

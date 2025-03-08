<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{

    public function createRestaurant(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required|integer|exists:locations,id'
        ]);

        $restaurant = new Restaurant;
        $restaurant->name = $request->name;
        $restaurant->description = $request->description;
        $restaurant->location_id = $request->location_id;
        $restaurant->save();

        $restaurantCheck = Restaurant::find($restaurant->id);

        return response()->json($restaurantCheck);
    }

    //Get all restaurants 
    public function getRestaurants()
    {
        $restaurant = Restaurant::all();
        if ($restaurant) {
            return response()->json($restaurant);
        } else {
            return response("No Restaurant was found.");
        }
    }

    //Get a restaurant
    public function getRestaurant($id)
    {
        try {
            $restaurant = Restaurant::findOrFail($id);
            return response()->json($restaurant);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Restaurant Not found with id: ",
                $id
            ], 404);
        }
    }

    //Update a Restaurant
    public function updateRestaurant(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required|integer|exists:locations,id'
        ]);
        try {
            $existingRestaurant = Restaurant::findOrFail($id);
            if ($existingRestaurant) {
                $existingRestaurant->name = $request->name;
                $existingRestaurant->description = $request->description;
                $existingRestaurant->location_id = $request->location_id;
                $existingRestaurant->save();

                return response()->json($existingRestaurant);
            } else {
                response()->json("No Record Found!");
            }
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Restaurant could not be updated!"
            ], 404);
        }
    }

    public function deleteRestaurant($id)
    {
        try {
            $existingRestaurant = Restaurant::findOrFail($id);
            if ($existingRestaurant) {                
                $existingRestaurant->delete();
                return response()->json([
                    "deleted" => $existingRestaurant
                ]);
            } else {
                return response("Restaurant does not exist");
            }
        } catch (\Exception $e) {
            return response()->json([
                "error" => "Restaurant could not be deleted!"
            ], 403);
        }
    }
}

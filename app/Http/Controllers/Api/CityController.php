<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::latest()->paginate(25);
        return CityResource::collection($cities)->additional([
            'message' => '',
            'status' =>  'success'
        ]);
    }
    public function show($id)
    {
        $city = City::with('country')->findOrFail($id);
        return CityResource::make($city)->additional(['status' => 'success', 'message' => '']);
    }

    public function store(CityRequest $request)
    {
        $City = City::create($request->validated() );
        return response()->json(['status' => 'success', 'data' => null, 'message' =>  trans('dashboard/admin.city.created')]);
    }
    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        return response()->json(['status' => 'success', 'data' => null, 'message' =>  trans('dashboard/admin.city.updated')]);
    }
    public function destroy(City $city)
    {
        $city->delete();
        return response()->json(['status' => 'success', 'data' => null, 'message' =>  trans('dashboard/admin.city.destroy')]);
    }
}

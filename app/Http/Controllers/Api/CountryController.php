<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::latest()->paginate(25);
        return CountryResource::collection($countries)->additional([
            'message' => '',
            'status' => 'success'
        ]);
    }

    public function show($id)
    {
        $country = Country::with("cities")->findOrFail($id);
        return CountryResource::make($country)->additional(['status' => 'success', 'message' => '']);
    }


    public function store(CountryRequest $request)
    {
        $country = Country::create($request->validated());
        return response()->json(['status' => 'success', 'data' => null, 'message' => trans('dashboard/admin.country.created')]);
    }

    public function update(CountryRequest $request, $id)
    {
        $country = Country::findOrFail($id);
        $country->update($request->validated());
        return response()->json(['status' => 'success', 'data' => null, 'message' => trans('dashboard/admin.country.updated')]);
    }

    public function destroy($country)
    {
        $country = Country::findOrFail($country);
        $country->delete();
        return response()->json(['status' => 'success', 'data' => null, 'message' => trans('dashboard/admin.country.destroy')]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AreaRequest;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::latest()->paginate(25);
        return AreaResource::collection($areas)->additional([
            'message' => '',
            'status' =>  'success'
        ]);
    }
    public function show($id)
    {
        $area = Area::with("city")->findOrFail($id);
        return AreaResource::make($area)->additional(['status' => 'success', 'message' => '']);
    }

    public function store(AreaRequest $request)
    {
        $area = Area::create($request->validated() );
        return response()->json(['status' => 'success', 'data' => null, 'message' =>  trans('dashboard/admin.district.created')]);
    }
    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->validated());
        return response()->json(['status' => 'success', 'data' => null, 'message' =>  trans('dashboard/admin.district.updated')]);
    }
    public function destroy(Area $area)
    {
        $area->delete();
        return response()->json(['status' => 'success', 'data' => null, 'message' =>  trans('dashboard/admin.district.destroy')]);
    }
}

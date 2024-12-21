<?php
// app/Http/Controllers/AssetController.php
namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::all();
        return response()->json($assets);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:assets',
            'value' => 'required|numeric',
        ]);

        $asset = Asset::create($request->all());
        return response()->json($asset, 201);
    }

    public function show($id)
    {
        $asset = Asset::findOrFail($id);
        return response()->json($asset);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:assets,serial_number,' . $id,
            'value' => 'required|numeric',
        ]);

        $asset = Asset::findOrFail($id);
        $asset->update($request->all());
        return response()->json($asset);
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();
        return response()->json(null, 204);
    }
}

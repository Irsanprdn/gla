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
        return view('asset.index', compact('assets'));
    }

    public function create()
    {
        return view('asset.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:assets',
            'value' => 'required|numeric',
        ]);

        $asset = Asset::create($request->all());
        return redirect()->route('asset.index')->with('success', 'Asset created successfully!');
    }

    public function show($id)
    {
        $asset = Asset::findOrFail($id);
        return view('asset.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        return view('asset.edit', compact('asset'));
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
        return redirect()->route('asset.index')->with('success', 'Asset updated successfully!');
    }

    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        $asset->delete();
        return redirect()->route('asset.index')->with('success', 'Asset deleted successfully!');
    }
}

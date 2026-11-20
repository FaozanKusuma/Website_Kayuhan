<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class AdminPackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function edit(Package $package)
    {
        $packages = Package::latest()->get();
        return view('admin.packages.index', compact('packages', 'package'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Package::create($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Paket layanan ditambahkan!');
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $package->update($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Paket layanan diperbarui!');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', 'Paket layanan dihapus!');
    }
}
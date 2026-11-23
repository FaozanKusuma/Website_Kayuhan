<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    public function index()
    {
        $teams = TeamMember::latest()->get();
        return view('admin.teams.index', compact('teams'));
    }

    public function edit(TeamMember $team)
    {
        $teams = TeamMember::latest()->get();
        return view('admin.teams.index', compact('teams', 'team'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('images/foto_karyawan'), $filename);
            $validated['photo'] = 'images/foto_karyawan/' . $filename;
        }

        TeamMember::create($validated);

        return redirect()->route('admin.teams.index')->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($team->photo && file_exists(public_path($team->photo))) {
                @unlink(public_path($team->photo));
            } elseif ($team->photo && Storage::disk('public')->exists($team->photo)) {
                Storage::disk('public')->delete($team->photo);
            }

            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('images/foto_karyawan'), $filename);
            $validated['photo'] = 'images/foto_karyawan/' . $filename;
        }

        $team->update($validated);

        return redirect()->route('admin.teams.index')->with('success', 'Data anggota tim diperbarui!');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo && file_exists(public_path($team->photo))) {
            @unlink(public_path($team->photo));
        } elseif ($team->photo && Storage::disk('public')->exists($team->photo)) {
            Storage::disk('public')->delete($team->photo);
        }

        $team->delete();

        return redirect()->route('admin.teams.index')->with('success', 'Anggota tim berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $experiences = $profile ? $profile->experiences : [];
        return view('admin.experience.index', compact('experiences'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|string|max:100',
            'deskripsi' => 'required',
            'foto_project' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = Profile::first();
        if (!$profile) {
            return back()->with('error', 'Silakan isi data profil terlebih dahulu!');
        }

        $fotoPath = null;
        if ($request->hasFile('foto_project')) {
            $fotoPath = $request->file('foto_project')->store('experiences', 'public');
        }

        Experience::create([
            'profile_id' => $profile->id,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'foto_project' => $fotoPath,
        ]);

        return back()->with('success', 'Pengalaman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        $experiences = Experience::all();
        return view('admin.experience.index', compact('experience', 'experiences'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|string|max:100',
            'deskripsi' => 'required',
            'foto_project' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $experience = Experience::findOrFail($id);

        if ($request->hasFile('foto_project')) {
            if ($experience->foto_project) {
                Storage::disk('public')->delete($experience->foto_project);
            }
            $experience->foto_project = $request->file('foto_project')->store('experiences', 'public');
        }

        $experience->judul = $request->judul;
        $experience->tahun = $request->tahun;
        $experience->deskripsi = $request->deskripsi;
        $experience->save();

        return redirect()->route('experience.index')->with('success', 'Pengalaman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        if ($experience->foto_project) {
            Storage::disk('public')->delete($experience->foto_project);
        }
        $experience->delete();

        return back()->with('success', 'Pengalaman berhasil dihapus!');
    }
}

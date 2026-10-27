<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function publicView()
    {
        $profile = Profile::first();
        $experiences = $profile ? $profile->experiences : [];
        $skills = $profile ? $profile->skills : []; // Mengambil data skills

        // Kirimkan $skills ke Blade view
        return view('portofolio', compact('profile', 'experiences', 'skills'));
    }

    public function edit()
    {
        $profile = Profile::first() ?? new Profile();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'profesi' => 'required|string|max:255',
            'bio' => 'required',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = Profile::first() ?? new Profile();

        if ($request->has('hapus_foto') && $profile->foto_profil) {
            Storage::disk('public')->delete($profile->foto_profil);
            $profile->foto_profil = null;
        }

        if ($request->hasFile('foto_profil')) {
            if ($profile->foto_profil) {
                Storage::disk('public')->delete($profile->foto_profil);
            }
            $profile->foto_profil = $request->file('foto_profil')->store('profiles', 'public');
        }

        $profile->nama = $request->nama;
        $profile->profesi = $request->profesi;
        $profile->bio = $request->bio;
        $profile->website = $request->website;
        $profile->save();

        return back()->with('success', 'Data Profil berhasil diperbarui!');
    }
}

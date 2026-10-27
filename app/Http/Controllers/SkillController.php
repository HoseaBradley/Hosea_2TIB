<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Profile;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $profile = Profile::first();$skills = $profile ? $profile->skills : [];
        return view('admin.skill.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_skill' => 'required|string|max:255',
            'tingkat_keahlian' => 'required|integer|min:1|max:100',
        ]);

        $profile = Profile::first();
        if (!$profile) {
            return back()->with('error', 'Silakan isi data profil terlebih dahulu!');
        }

        Skill::create([
            'profile_id' => $profile->id,
            'nama_skill' => $request->nama_skill,
            'tingkat_keahlian' => $request->tingkat_keahlian,
        ]);

        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    // Tambahkan method edit
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);$skills = Skill::all();
        return view('admin.skill.index', compact('skill', 'skills'));
    }

    // Tambahkan method update
    public function update(Request $request,$id)
    {
        $request->validate([
            'nama_skill' => 'required|string|max:255',
            'tingkat_keahlian' => 'required|integer|min:1|max:100',
        ]);

        $skill = Skill::findOrFail($id);$skill->update([
            'nama_skill' => $request->nama_skill,
            'tingkat_keahlian' => $request->tingkat_keahlian,
        ]);

        return redirect()->route('skill.index')->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);$skill->delete();

        return back()->with('success', 'Skill berhasil dihapus!');
    }
}

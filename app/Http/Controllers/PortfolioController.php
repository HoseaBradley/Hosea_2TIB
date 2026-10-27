<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    // Tambah method home ini untuk paparan awam /portofolio
    public function home()
    {
        $portfolios = Portfolio::with('category')->latest()->get();
        return view('portofolio', compact('portfolios'));
    }

    public function index()
    {
        $portfolios = Portfolio::with('category')->latest()->get();
        return view('admin.portofolio.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.portofolio.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link'        => 'nullable|url',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('portfolios', 'public');
        }

        Portfolio::create([
            'category_id' => $request->category_id,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $gambarPath,
            'link'        => $request->link,
        ]);

        return redirect()->route('portofolio.index')->with('success', 'Portofolio berjaya ditambah!');
    }

    public function edit(Portfolio $portofolio)
    {
        $categories = Category::all();
        return view('admin.portofolio.edit', compact('portofolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portofolio)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'required',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'link'        => 'nullable|url',
        ]);

        if ($request->has('hapus_gambar') && $portofolio->gambar) {
            Storage::disk('public')->delete($portofolio->gambar);
            $portofolio->gambar = null;
        }

        if ($request->hasFile('gambar')) {
            if ($portofolio->gambar) {
                Storage::disk('public')->delete($portofolio->gambar);
            }
            $portofolio->gambar = $request->file('gambar')->store('portfolios', 'public');
        }

        $portofolio->update([
            'category_id' => $request->category_id,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'gambar'      => $portofolio->gambar,
            'link'        => $request->link,
        ]);

        return redirect()->route('portofolio.index')->with('success', 'Portofolio berjaya dikemas kini!');
    }

    public function destroy(Portfolio $portofolio)
    {
        if ($portofolio->gambar) {
            Storage::disk('public')->delete($portofolio->gambar);
        }
        $portofolio->delete();

        return redirect()->route('portofolio.index')->with('success', 'Portofolio berjaya dihapus!');
    }
}

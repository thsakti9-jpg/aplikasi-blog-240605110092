<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\KategoriArtikel;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $kategori = KategoriArtikel::withCount('artikel')
            ->orderBy('nama_kategori', 'asc')
            ->get();
        
        $query = Artikel::with(['penulis', 'kategori'])->orderBy('id', 'desc');
        
        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }
        
        $artikel = $query->paginate(5);
        $selectedCategory = null;
        
        if ($request->filled('kategori')) {
            $selectedCategory = KategoriArtikel::find($request->kategori);
        }
        
        return view('blog.index', compact('artikel', 'kategori', 'selectedCategory'));
    }
    
    public function show($id)
    {
        $artikel = Artikel::with(['penulis', 'kategori'])->findOrFail($id);
        
        $terkait = Artikel::with(['penulis', 'kategori'])
            ->where('id_kategori', $artikel->id_kategori)
            ->where('id', '!=', $artikel->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
        
        $kategori = KategoriArtikel::withCount('artikel')
            ->orderBy('nama_kategori', 'asc')
            ->get();
        
        return view('blog.show', compact('artikel', 'terkait', 'kategori'));
    }
}
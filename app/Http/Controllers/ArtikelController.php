<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artikel = artikel::all();
        return view('dashboard.artikel.index', compact('artikel'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function publikindex()
    {
        $artikel = artikel::all();
        return view('artikel', compact('artikel'));
    }
    
    public function create()
    {
        return view('dashboard.artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',

        ]);
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('img/artikel','public');
        }

        $artikel = new artikel([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image' => $image,
        ]);
        $artikel->save();
    
        return redirect()->route('artikel.index')->with('success', 'Data Berhasil Ditambah');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $artikel = artikel::find($id);
    
    
        // Kirim data ke view
        return view('detailartikel', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $artikel = artikel::find($id);
        return view('dashboard.artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, artikel $id)
    {
        $validate = $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        $image = $id->image;
        if ($request->hasFile('image')) {
            if ($id->image && file_exists(storage_path('app/public/' . $id->image))) {
                unlink(storage_path('app/public/' . $id->image));
            }
            $image = $request->file('image')->store('img/camp', 'public');

        }
        $id->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image' => $image,
        ]);

        return redirect()->route('artikel.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $artikel = artikel::where('id',$id);
        $artikel->delete();
        return redirect()->route('artikel.index')->with('success', 'Data Berhasil Dihapus');
    }
}

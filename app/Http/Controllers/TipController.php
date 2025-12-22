<?php

namespace App\Http\Controllers;

use App\Models\tip;
use Illuminate\Http\Request;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tip = tip::all();
        return view('dashboard.tip.index', compact('tip'));
    }
    public function publikindex()
    {
        $tip = tip::all();
        return view('tips', compact('tip'));
    }

    /**
     * Show the form for creating a new resource.
     */

    
    public function create()
    {
        return view('dashboard.tip.create');
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
            $image = $request->file('image')->store('img/tip','public');
        }

        $tip = new tip([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'image' => $image,
        ]);
        $tip->save();
    
        return redirect()->route('tip.index')->with('success', 'Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tip = tip::find($id);
    
    
        // Kirim data ke view
        return view('tipdetail', compact('tip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tip = tip::find($id);
        return view('dashboard.tip.edit', compact('tip'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tip $id)
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

        return redirect()->route('tip.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tip = tip::where('id',$id);
        $tip->delete();
        return redirect()->route('tip.index')->with('success', 'Data Berhasil Dihapus');
    }
}

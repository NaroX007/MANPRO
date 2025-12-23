<?php

namespace App\Http\Controllers;

use App\Models\camp_ground;
use App\Models\camp_rating;
use App\Models\camp_images;
use App\Models\artikel;
use App\Models\tip;

use App\Models\fasilitas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CampGroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $camp = camp_ground::all();
        return view('dashboard.camp_ground.index', compact('camp'));
    }

    public function publikindex(Request $request)
    {
        if ($request->has('latitude') && $request->has('longitude')) {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

            $camp = camp_ground::selectRaw(
                'id, nama, image, latitude, longitude, ( 6371 * ACOS( COS( RADIANS(?) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS(?) ) + SIN( RADIANS(?) ) * SIN( RADIANS( latitude ) ) ) ) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->orderBy('distance')
            ->paginate(6);
        } else {
            $camp = camp_ground::paginate(6);
        }

        $artikel = artikel::paginate(8);
        $tip = tip::paginate(8);
        return view('home', compact('camp', 'artikel', 'tip'));
    }

    public function allindex(Request $request)
    {
        $search = $request->input('search');

        $query = camp_ground::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        if ($request->has('latitude') && $request->has('longitude') && $request->latitude != null) {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

            $query->selectRaw(
                '*, ( 6371 * ACOS( COS( RADIANS(?) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS(?) ) + SIN( RADIANS(?) ) * SIN( RADIANS( latitude ) ) ) ) AS distance',
                [$latitude, $longitude, $latitude]
            )->orderBy('distance');
        }

        $camp = $query->get();
        
        return view('campground', compact('camp'));
    }

    public function kategori(Request $request)
    {
        $query = camp_ground::query(); // Mulai dengan query builder
        if ($request->has('latitude') && $request->has('longitude')) {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
    
            $query->selectRaw(
                'id, image, nama, latitude, longitude, kategori, ( 6371 * ACOS( COS( RADIANS(?) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS(?) ) + SIN( RADIANS(?) ) * SIN( RADIANS( latitude ) ) ) ) AS distance',
                [$latitude, $longitude, $latitude]
            )->orderBy('distance');
        }
    
        // Filter berdasarkan kategori jika ada
       
        if ($request->has('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }
    
        // Eksekusi query
        $camp = $query->get();
    
        return view('loc', compact('camp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.camp_ground.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori' => 'required|string',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'images.*.file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'fasilitas.*.jenis_fasilitas' => 'required|string',
            'fasilitas.*.deskripsi' => 'nullable|string',
            'phone' => 'nullable',

        ]);
        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('img/camp','public');
        }

        $camp = new camp_ground([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $image,
            'phone' => $request->phone,
        ]);
        $camp->save();

        foreach ($request->fasilitas as $fasilitasData) {
            $camp->fasilitas()->create([
                'jenis_fasilitas' => $fasilitasData['jenis_fasilitas'],
                'deskripsi' => $fasilitasData['deskripsi'],
            ]);
        }

        if ($request->has('images')) {
            foreach ($request->images as $imageData) {
                if (isset($imageData['file'])) {
                    camp_images::create([
                        'camp_id' => $camp->id,
                        'image' => $imageData['file']->store('img/camp', 'public'),
                        'caption' => $imageData['caption'] ?? null,
                    ]);
                }
            }
        }
    
        return redirect()->route('camp.index')->with('success', 'Data Berhasil Ditambah');

    }

    /**
     * Display the specified resource.
     */
    public function show(camp_ground $camp_ground)
    {
        
        // Ambil semua fasilitas dan gambar terkait dengan camp
        $fasilitas = $camp_ground->fasilitas;
        $images = $camp_ground->images;
    
        // Kirim data ke view
        return view('detailcamp', compact('camp_ground', 'fasilitas', 'images'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $camp = camp_ground::find($id);
        return view('dashboard.camp_ground.edit', compact('camp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string',
        'kategori' => 'required|string',
        'deskripsi' => 'required',
        'alamat' => 'required',
        'latitude' => 'nullable',
        'longitude' => 'nullable',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'images.*.file' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'fasilitas.*.jenis_fasilitas' => 'required|string',
        'fasilitas.*.deskripsi' => 'nullable|string',
        'phone' => 'nullable',
    ]);

    $camp = camp_ground::findOrFail($id);

    // Update main image if a new one is uploaded
    if ($request->hasFile('image')) {
        // Delete old image
        if ($camp->image) {
            Storage::disk('public')->delete($camp->image);
        }

        // Save new image
        $camp->image = $request->file('image')->store('img/camp', 'public');
    }

    // Update camp_ground data
    $camp->update([
        'nama' => $request->nama,
        'kategori' => $request->kategori,
        'deskripsi' => $request->deskripsi,
        'alamat' => $request->alamat,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'phone' => $request->phone,
    ]);

    // Update fasilitas
    $camp->fasilitas()->delete(); // Remove old fasilitas
    foreach ($request->fasilitas as $fasilitasData) {
        $camp->fasilitas()->create([
            'jenis_fasilitas' => $fasilitasData['jenis_fasilitas'],
            'deskripsi' => $fasilitasData['deskripsi'],
        ]);
    }

    // Update images
    if ($request->has('images')) {
        foreach ($request->images as $imageData) {
            if (isset($imageData['file'])) {
                camp_images::create([
                    'camp_id' => $camp->id,
                    'image' => $imageData['file']->store('img/camp', 'public'),
                    'caption' => $imageData['caption'] ?? null,
                ]);
            }
        }
    }

    return redirect()->route('camp.index')->with('success', 'Data Berhasil Diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $camp=camp_ground::where('id',$id);
        $camp->delete();
        return redirect()->route('camp.index')->with('success', 'Data Berhasil Dihapus');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camp_ground extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi', 'alamat', 'latitude', 'longitude', 'image', 'kategori', 'phone'];

    public function ratings()
    {
        return $this->hasMany(camp_rating::class);
    }

    public function fasilitas()
    {
        return $this->hasMany(fasilitas::class, 'camp_id');
    }

    public function images()
    {
    return $this->hasMany(camp_images::class, 'camp_id');
    }
}

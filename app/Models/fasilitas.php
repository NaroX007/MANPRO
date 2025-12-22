<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitas extends Model
{
    use HasFactory;

    protected $table = 'camp_fasilitas';
    
    protected $fillable = ['camp_id', 'jenis_fasilitas', 'deskripsi'];

    public function campGround()
    {
        return $this->belongsTo(camp_ground::class, 'camp_id');
    }
}

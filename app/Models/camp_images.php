<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camp_images extends Model
{
    use HasFactory;

    protected $fillable = ['camp_id', 'image'];

    public function campGround()
    {
        return $this->belongsTo(camp_ground::class, 'camp_id');
    }
}

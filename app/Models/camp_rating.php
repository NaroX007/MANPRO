<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class camp_rating extends Model
{
    use HasFactory;

    protected $fillable = ['camp_ground_id', 'rating', 'review'];

    public function campGround()
    {
        return $this->belongsTo(camp_ground::class);
    }
}

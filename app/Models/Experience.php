<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'judul', 'tahun', 'deskripsi', 'foto_project'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

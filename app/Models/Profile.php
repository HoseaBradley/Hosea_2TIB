<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'profesi', 'bio', 'foto_profil', 'website'];

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function skills()
{
    return $this->hasMany(Skill::class);
}
}

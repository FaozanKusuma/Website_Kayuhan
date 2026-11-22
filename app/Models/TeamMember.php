<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $guarded = [];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }

        if (str_starts_with($this->photo, 'images/')) {
            return asset($this->photo);
        }

        if (file_exists(public_path('images/foto_karyawan/' . $this->photo))) {
            return asset('images/foto_karyawan/' . $this->photo);
        }

        if (file_exists(public_path('images/' . $this->photo))) {
            return asset('images/' . $this->photo);
        }

        return asset('storage/' . $this->photo);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        if (str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        if (file_exists(public_path('images/foto_menu/' . $this->image))) {
            return asset('images/foto_menu/' . $this->image);
        }

        if (file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }

        return asset('storage/' . $this->image);
    }
}
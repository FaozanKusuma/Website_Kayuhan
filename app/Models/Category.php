<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = []; // Agar semua kolom bisa diisi (mass assignment)

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBerita extends Model
{
    use HasFactory;

    protected $fileNameToStore = ['id', 'name'];

    public function berita() {
        return $this->hasMany(Berita::class, 'category_berita_id');
    }
}

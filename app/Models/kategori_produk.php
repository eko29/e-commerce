<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori_produk extends Model
{
    use HasFactory;

    public function Produk()
    {
        return $this->hasMany('App\Models\produk', 'id_kategori', 'id_kategori');
    }
}

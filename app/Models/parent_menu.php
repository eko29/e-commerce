<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parent_menu extends Model
{
    use HasFactory;

    public function Kategori()
    {
        return $this->hasMany('App\Models\kategori_produk', 'id_menu', 'id');
    }
}

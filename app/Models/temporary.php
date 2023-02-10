<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temporary extends Model
{
    use HasFactory;

    public function Produk()
    {
        return $this->belongsTo('App\Models\produk', 'id_produk', 'id_produk');
    }
}

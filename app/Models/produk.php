<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    public function PicProduk()
    {
        return $this->hasMany('App\Models\pic_produk', 'id_produk', 'id_produk');
    }

    public function ColorProduk()
    {
        return $this->hasMany('App\Models\colour_produk', 'id_produk', 'id_produk');
    }

    public function SizeProduk()
    {
        return $this->hasMany('App\Models\size_produk', 'id_produk', 'id_produk');
    }

    public function Cities()
    {
        return $this->belongsTo('App\Models\Cities', 'id_cities', 'city_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alamat extends Model
{
    use HasFactory;

    public function user_cs()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
    public function provinsi()
    {
        return $this->belongsTo('App\Models\provinces', 'id_provinsi', 'province_id');
    }
    public function cities()
    {
        return $this->belongsTo('App\Models\cities', 'id_cities', 'city_id');
    }
    public function subdistricts()
    {
        return $this->belongsTo('App\Models\subdistricts', 'id_subcities', 'subdistrict_id');
    }
}

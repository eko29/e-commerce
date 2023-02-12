<?php
namespace App\Helpers;

use App\Models\parent_menu;
 
class Fungsi {
    public static function rupiah($angka){

        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;

    }
    
}
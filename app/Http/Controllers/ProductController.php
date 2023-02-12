<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\produk;
use App\Models\temporary;
use App\Models\Api;
use App\Models\provinces;
use App\Models\cities;
use App\Models\subdistricts;
use App\Models\alamat;
use App\Models\parent_menu;
use App\Models\kategori_produk;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function home(Request $request){
        $produk = produk::get();
        // dd($produk);
        return view('content.home',compact('produk'));
    }
    public function detail($detail)
    {
        $cekproduk = produk::with('PicProduk','Cities')->where('token', $detail)->first();
        
        if(is_null($cekproduk)){
            return view('content.404');
        }
        return view('content.detail_produk', compact('cekproduk'));
    }
    public function addcart(Request $request){
        $inv = Carbon::now()->format('YmdHisu');
        $auth = Auth::user()->id;
        // dd($auth,$inv,$request->color_option,$request->ukuran_option,$request->token,$request->item);
            // id_alamat
        $cek_produk = produk::where('token', $request->token)->first();
        

        if(is_null($cek_produk)){
            return back();
        }else{
            $cek_temp = temporary::where('id_produk', $cek_produk->id_produk)->first();
            if(!is_null($cek_temp)){
                temporary::where('id_produk', $cek_produk->id_produk)
                    ->update([
                        'id_color'     =>  $request->color_option,
                        'id_size'     =>  $request->ukuran_option,
                        'updated_at'=>date("Y-m-d H:i:s")
                    ]);
            }else{
                $tem = new temporary;
                $tem->invoice   = $inv;
                $tem->id_user   = $auth;
                $tem->id_produk = $cek_produk->id_produk;
                $tem->id_color  = $request->color_option;
                $tem->id_size   = $request->ukuran_option;
                $tem->weight    = $cek_produk->weight;
                $tem->save();
            }   
        }
        
        return redirect()->route('produk.addcart.po');
    }
    public function po(Request $request){
        $cek_temp = temporary::with('Produk')->where('id_user', Auth::user()->id)->get();
        $cek_user = alamat::where('id_user', Auth::user()->id)->where('status', 'Check')->first();
        $prov = provinces::get();
        $shipp = 0;
        if(!is_null($cek_user)){
            foreach($cek_temp as $tmp){
                $api = new Api;
                $ongkir = $api->RajaOngkir($tmp->produk->id_cities,501,1000,'jne');
                if($ongkir['rajaongkir']['results']['0']['costs']){
                   $val = $ongkir['rajaongkir']['results']['0']['costs'][0]['cost'][0]['value'];
                }else{
                    $api = new Api;
                    $ongkir = $api->RajaOngkir($tmp->produk->id_cities,501,1000,'pos');
                    if($ongkir['rajaongkir']['results']['0']['costs']){
                       $val = $ongkir['rajaongkir']['results']['0']['costs'][0]['cost'][0]['value'];
                    }else{
                        $api = new Api;
                        $ongkir = $api->RajaOngkir($tmp->produk->id_cities,501,1000,'tiki');
                        if($ongkir['rajaongkir']['results']['0']['costs']){
                           $val = $ongkir['rajaongkir']['results']['0']['costs'][0]['cost'][0]['value'];
                        }else{
                            $val = 0;
                        }
                    }
                }
                $shipp = $val + $val;
                
            }
        }
        
        return view('content.invoice',compact('cek_temp','prov','cek_user','shipp'));
    }
    public function city(Request $request, $id){
        $cities = cities::where("province_id",$id)
                    ->orderby("city_name",'asc')
                    ->pluck("city_name","city_id");
        return json_encode($cities);

    }
    public function subdistrict(Request $request, $id){
        $cities = subdistricts::where("city_id", $id)
                    ->orderby("subdistrict_name",'asc')
                    ->pluck("subdistrict_name","subdistrict_id");
        return json_encode($cities);
    }
    public function simpan_alamat(Request $request){
        $request->validate([
            'alamat'        => ['required', 'string', 'max:255'],
            'provinsi'      => ['required'],
            'kota'          => ['required'],
            'kecamatan'     => ['required'],
            'telp'          => ['required'],
        ],
        [
            'alamat.required'       =>'Total tagihan Tidak boleh kosong',
            'provinsi.required'     => 'Nama tagihan harus diisi',
            'kota.required'         => 'Jatuh Tempo harus diisi',
            'kecamatan.required'    => 'Nama tagihan harus diisi',
            'telp.required'         => 'Jatuh Tempo harus diisi',
        ]);
        
        $new_almt = new alamat;
        $new_almt->id_user      = Auth::user()->id;
        $new_almt->id_provinsi  = $request->provinsi;
        $new_almt->id_cities    = $request->kota;
        $new_almt->id_subcities = $request->kecamatan;
        $new_almt->almt         = $request->alamat;
        $new_almt->no_telp      = $request->telp;
        $new_almt->save();
        
        return redirect()->route('produk.addcart.po');
        
    }
    public function ketegori_gender(Request $request, $kategori, $gender){
        if($gender == "pria"){
            $gd = 1;
        }else{
            $gd = 2;
        }
        $cek_mn = parent_menu::with('Kategori')->where('menu', $kategori)->first();
        $cek_kat = kategori_produk::with('Produk')->where('id_menu', $cek_mn->id)->where('jk', $gd)->get();
        // dd($kategori,$cek_mn->id,$cek_kat);
        return view('content.kategori_gender',compact('cek_mn','cek_kat','gender'));
    }
}

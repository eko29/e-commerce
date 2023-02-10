<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\produk;
use App\Models\temporary;
use Carbon\Carbon;
use Auth;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($detail)
    {
        $cekproduk = produk::with('PicProduk','Cities')->where('token', $detail)->first();
        // dd($cekproduk);
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
                $tem->save();
            }
        }
        
        return redirect()->route('produk.addcart.po');
    }
    public function po(Request $request){
        $cek_temp = temporary::with('Produk')->where('id_user', Auth::user()->id)->get();
// dd($cek_temp);
        return view('content.invoice',compact('cek_temp'));
    }
}

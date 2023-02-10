@extends('layouts.default')

@section('content') 
<style type="text/css">
  .increment-btn span {
    -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
    -khtml-user-select: none; /* Konqueror HTML */
    -moz-user-select: none; /* Old versions of Firefox */
    -ms-user-select: none; /* Internet Explorer/Edge */
    user-select: none; /* Non-prefixed version, currently */
  }

  .with-inc input {
    background: transparent !important;
        width: 60px;
    display: inline-block;
      vertical-align: middle;
  }

  .counter{
   width: 30%;
   display: flex;
   justify-content: space-between;
   align-items: center;
   /*background: transparent !important;
        width: 60px;*/
  }
  .btn_cart{
   width: 40px;
   height: 40px;
   border-radius: 50%;
   background-color: #d9d9d9;
   display: flex;
   justify-content: center;
   align-items: center;
   font-size: 20px;
   font-family: 'Open Sans';
   font-weight: 900;
   color: #202020;
   cursor: pointer;
  }
  .count{
   font-size: 20px;
   font-family: 'Open Sans';
   font-weight: 900;
   color: #202020;
  }
</style> 
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>E-commerce</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">E-commerce</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{ $cekproduk->nama_produk }}</h3>
                <div class="col-12">
                  <img src="/img/{{ $cekproduk->PicProduk[0]->pic }}" class="product-image" alt="Product Image">
                </div>
                <div class="col-12 product-image-thumbs">
                  @forelse ($cekproduk->PicProduk as $t)
                    <div class="product-image-thumb"><img src="/img/{{ $t->pic }}" alt="Product Image"></div>
                  @empty
                  @endforelse
                </div>
              </div>
              
              <div class="col-12 col-sm-6">
                <form method="get" action="{{ route('product.addcart') }}" class>
                  <h3 class="my-3">{{ $cekproduk->nama_produk }}</h3>

                  <hr>
                  <h4>Pilih Warna</h4>
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    @forelse ($cekproduk->ColorProduk as $c)
                      <label class="btn btn-default text-center">
                        <input type="radio" value="{{ $c->id }}" name="color_option" id="color_option_a2" autocomplete="off">
                        {{ $c->colour }}
                    </label>
                    @empty
                    @endforelse
                    
                  </div>

                  <h4 class="mt-3">Pilih Ukuran</h4>
                  <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    @forelse ($cekproduk->SizeProduk as $s)
                      <label class="btn btn-default text-center">
                        <input type="radio" value="{{ $s->id }}" name="ukuran_option" id="color_option_b1" autocomplete="off">
                        {{ $s->size }}
                      </label>
                    @empty
                    @endforelse                  
                  </div>
                  <input type="hidden" name="token" value="{{ $cekproduk->token }}">
                  <div class="bg-gray py-2 px-3 mt-4">
                    <h2 class="mb-0">
                      {{ Fungsi::rupiah($cekproduk->harga_produk) }}
                    </h2>
                    <h4 class="mt-0">
                      <small>Disc. {{ $cekproduk->diskon }} </small>
                    </h4>
                  </div>
                  <div class="mt-4">
                    <div class="counter with-inc">
                      <div class="btn_cart increment-btn decrement">-</div>
                        <div class="count"><span id="itung">0</span>
                          <input hidden class="input-number item" id="kuantiti" name="item" type="number" value="0" min="0" max="99" readonly>
                        </div>
                      <div class="btn_cart increment-btn increment">+</div>
                    </div>
                  </div>
                  
                  <div class="mt-4">
                    <button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fas fa-cart-plus fa-lg mr-2"></i>Add to Cart</button>
                      

                    <!-- <div class="btn btn-default btn-lg btn-flat">
                      <i class="fas fa-heart fa-lg mr-2"></i>
                      Add to Wishlist
                    </div> -->
                  </div>
                </form>
              </div>
              
              <div class="col-12 col-sm-6">
                <h3 class="my-3">Deskripsi</h3>
                {!! nl2br($cekproduk->deskripsi) !!}
              </div>
              <div class="col-12 col-sm-6">
                <h3 class="my-3">Spesifikasi</h3>
                <table class="table table-sm">
                    <tbody>
                      @if($cekproduk->id_cities)
                        <tr>
                          <td>Dikirim Dari</td>
                          <td>
                            {{ $cekproduk->Cities->city_name }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->merek)
                        <tr>
                          <td>Merek</td>
                          <td>
                            {{ $cekproduk->merek }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->garis_Leher)
                        <tr>
                          <td>Garis Leher</td>
                          <td>
                            {{ $cekproduk->garis_Leher }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->panjang_Lengan)
                        <tr>
                          <td>Panjang Lengan</td>
                          <td>
                            {{ $cekproduk->panjang_Lengan }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->acara)
                        <tr>
                          <td>Acara</td>
                          <td>
                            {{ $cekproduk->acara }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->bahan)
                        <tr>
                          <td>Bahan</td>
                          <td>
                            {{ $cekproduk->bahan }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->model)
                        <tr>
                          <td>Model</td>
                          <td>
                            {{ $cekproduk->model }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->u_jumbo)
                        <tr>
                          <td>Ukuran Jumbo</td>
                          <td>
                            {{ $cekproduk->u_jumbo }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->panjang_celana)
                        <tr>
                          <td>Panjang Celana</td>
                          <td>
                            {{ $cekproduk->panjang_celana }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->panjang_dress_rok)
                        <tr>
                          <td>Panjang Dress Rok</td>
                          <td>
                            {{ $cekproduk->panjang_dress_rok }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->musim)
                        <tr>
                          <td>Musim</td>
                          <td>
                            {{ $cekproduk->musim }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->kecil)
                        <tr>
                          <td>Kecil</td>
                          <td>
                            {{ $cekproduk->kecil }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->negara_asal)
                        <tr>
                          <td>Negara Asal</td>
                          <td>
                            {{ $cekproduk->negara_asal }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->motif)
                        <tr>
                          <td>Motif</td>
                          <td>
                            {{ $cekproduk->motif }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->gaya)
                        <tr>
                          <td>Gaya</td>
                          <td>
                            {{ $cekproduk->gaya }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->stok)
                        <tr>
                          <td>Stok</td>
                          <td>
                            {{ $cekproduk->stok }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->jenis_atasan)
                        <tr>
                          <td>Jenis Atasan</td>
                          <td>
                            {{ $cekproduk->jenis_atasan }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->mode_kancing)
                        <tr>
                          <td>Mode Kancing</td>
                          <td>
                            {{ $cekproduk->mode_kancing }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->wide_fit)
                        <tr>
                          <td>Wide Fit</td>
                          <td>
                            {{ $cekproduk->wide_fit }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->tipe_pengikat)
                        <tr>
                          <td>Tipe Pengikat</td>
                          <td>
                            {{ $cekproduk->tipe_pengikat }}
                          </td>
                        </tr>                        
                      @endif
                      @if($cekproduk->tinggi_sepatu)
                        <tr>
                          <td>Tinggi Sepatu</td>
                          <td>
                            {{ $cekproduk->tinggi_sepatu }}
                          </td>
                        </tr>                        
                      @endif
                      <tr>
                          <td></td>
                          <td></td>
                        </tr>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  </div>

@endsection
@section('scripts')
  <script type="text/javascript">
    
    $(function() {
      $('body').on('click', '.increment:not(.disabled)', function() {
        var $input = $(this).parents('.with-inc').find('.input-number');
        
        updateItem('+', $input);
      });

      $('body').on('click', '.decrement:not(.disabled)', function() {
        var $input = $(this).parents('.with-inc').find('.input-number');
        var val = parseInt($input.val());
        if (val - 1 >= $input.attr('min')) {
          updateItem('-', $input);
        }

      });
      
      function updateItem(operation, item) {
        var val = parseInt(item.val());

        if (operation == '+') {
          var newval = val + 1;
        } else if (operation == '-') {
          var newval = val - 1;
          
        } else {
          return true;
        }

        item.val(newval);
        document.getElementById("itung").innerHTML = newval;
      }
    });

  </script>
@endsection
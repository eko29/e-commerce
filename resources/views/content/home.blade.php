@extends('layouts.default')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @foreach($produk as $pp)
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <a href="{{ route('product.detail', ['token' => $pp->token]) }}">
                  <img class="img-fluid" src="/img/{{ $pp->PicProduk[0]->pic }}" alt="Photo">
                    @php
                      $num_char = 40;
                      $text = $pp->nama_produk;
                    @endphp
                    {{ substr($text, 0, $num_char) }}...<br>
                    @if($pp->diskon)
                      {{ Fungsi::rupiah($pp->harga_produk-($pp->harga_produk*$pp->diskon/100)) }}
                    @else
                      {{ Fungsi::rupiah($pp->harga_produk) }}
                    @endif
                  </a>
                </div><!-- /.card-body -->
              </div>
            </div>
          @endforeach
        </div>
          
          <!-- /.col -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@extends('layouts.default')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $cek_mn->menu }} {{ $gender }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $cek_mn->menu }} {{ $gender }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @forelse ($cek_kat as $p)
            @foreach($p->Produk as $pp)
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
            @endforeach
            
              <!-- /.card -->
            </div>
          @empty
          @endforelse
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@extends('layouts.default')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <!-- /.col -->
              </div>
              <!-- info row -->
              
              @if(!is_null($cek_user))
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    To
                    <address>
                      <strong>{{ $cek_user->user_cs->name }} </strong><br>
                      {{ $cek_user->almt }}<br>
                      {{ $cek_user->subdistricts->subdistrict_name }}<br>
                      {{ $cek_user->cities->city_name }}<br>
                      {{ $cek_user->provinsi->province_name }}<br>
                      Phone: {{ $cek_user->no_telp }}
                    </address>
                  </div>
                </div>
              @endif

              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Alamat Pengiriman
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Alamat Pengirim</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('produk.simpan.alamat') }}" method="POST">
                        @csrf
                        <div class="card-body">
                          <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" placeholder="Alamat" name="alamat">
                          </div>
                          <div class="input-group input-group-sm mb-3">
                            <select class="form-control select2 placeholder-provinsi" style="width: 100%;" name="provinsi">
                              <option selected="selected"></option>
                              @forelse ($prov as $p)    
                                <option value="{{ $p->province_id }}">{{ $p->province_name }}</option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                          <div class="input-group input-group-sm mb-3">
                            <select class="form-control select2 placeholder-kota" style="width: 100%;" name="kota">
                              <option selected="selected"></option>
                            </select>
                          </div>
                          <div class="input-group input-group-sm mb-3">
                            <select class="form-control select2 placeholder-kecamatan" style="width: 100%;" name="kecamatan">
                              <option selected="selected"></option>
                            </select>
                          </div>
                          <div class="input-group input-group-sm mb-3">
                            <input type="text" class="form-control" placeholder="No Telp" name="telp">
                          </div>
                          <div class="input-group input-group-sm mb-3">
                            <span class="input-group-append">
                              <button type="submit" class="btn btn-info btn-flat">Submit</button>
                            </span>
                          </div>
                          <!-- /input-group -->
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                        $ttl = 0;
                      @endphp
                      @forelse ($cek_temp as $t)
                        <tr>
                          <td>{{ $t->qty }}</td>
                          <td>{{ $t->Produk->nama_produk }}</td>
                          <td>{{ Fungsi::rupiah($t->Produk->harga_produk) }}</td>
                          <td>{{ $t->Produk->diskon }}%</td>
                          <td>
                            @php
                              $hrg = ($t->Produk->harga_produk-($t->Produk->harga_produk*$t->Produk->diskon/100))*$t->qty;
                              $ttl = $ttl + $hrg;
                            @endphp
                            {{ Fungsi::rupiah($hrg) }}
                          </td>
                        </tr>
                      @empty
                      @endforelse
                      
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Metode Bayar</p>
                  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    <label for="pay_bank_Mandiri">
                      <input type="radio" id="pay_bank_Mandiri" name="payment_method" value="MDR"> <strong>Mandiri (Transfer Bank)</strong>
                      <div class="info-block">
                        <p>Melalui ATM, Mobile Banking atau Internet Banking</p>
                      </div>
                    </label>
                    <label for="pay_bank_BCA">
                      <input type="radio" id="pay_bank_BCA" name="payment_method" value="RINTIS_BCA" > <strong>BCA (Transfer Bank)</strong>
                      <div class="info-block">
                        <p>Melalui ATM, Mobile Banking atau Internet Banking</p>
                      </div>
                    </label>
                    <label for="pay_narobil">
                      <input type="radio" id="pay_narobil" name="payment_method" value="NAROBIL"> <strong>Narobil</strong>
                      <div class="info-block">
                        <p>Melalui Indomaret/Alfamart/Alfamidi</p>
                      </div>
                    </label>
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{ Fungsi::rupiah($ttl) }}</td>
                      </tr>
                      <tr>
                        <th>Kupon:</th>
                        <td>{{ Fungsi::rupiah($shipp) }}</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>{{ Fungsi::rupiah($shipp) }}</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{ Fungsi::rupiah($ttl+$shipp) }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2();
      $(".placeholder-provinsi").select2({
          placeholder: "Pilih Provinsi",
          allowClear: true
      });
      $(".placeholder-kota").select2({
          placeholder: "Pilih Kota/Kabupaten",
          allowClear: true
      });
      $(".placeholder-kecamatan").select2({
          placeholder: "Pilih Kecamatan",
          allowClear: true
      });
      $('select[name="provinsi"]').on('change', function() {
          var stateID = $(this).val();
          if(stateID){
                  $.ajax({
                  url: '/city/'+stateID,
                  type: "GET",
                  dataType: "json",
                  success:function(data){
                      $('select[name="kota"]').empty();
                      $('select[name="kota"]').append('<option value=""></option>');
                      $('select[name="kecamatan"]').empty();
                      $('select[name="kecamatan"]').append('<option selected></option>');
                      $.each(data, function(key, value) {
                        $('select[name="kota"]').append('<option value="'+ key +'">'+ value +'</option>');
                      });
                  }
              });
          }else{
              $('select[name="kab_kot"]').empty();
          }
      });
      $('select[name="kota"]').on('change', function() {
          var stateID = $(this).val();
          if(stateID){
                  $.ajax({
                  url: '/subdistrict/'+stateID,
                  type: "GET",
                  dataType: "json",
                  success:function(data){
                      $('select[name="kecamatan"]').empty();
                      $('select[name="kecamatan"]').append('<option selected></option>');
                      $.each(data, function(key, value) {
                          $('select[name="kecamatan"]').append('<option value="'+ key +'">'+ value +'</option>');
                      });
                  }
              });
          }else{
              $('select[name="kecamatan"]').empty();
          }
      });
    });

  </script>
@endsection
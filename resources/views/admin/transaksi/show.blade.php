@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-8">
            <div class="card mb-4 shadow-lg rounded card" style="margin: 2%; padding:1% ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data transaksi</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Transaksi</label>
                        <input type="text" name="kode_transaksi"
                            class="form-control mb-2  @error('kode_transaksi') is-invalid @enderror"
                            placeholder="Kode transaksi" value="{{ $transaksis->kode_transaksi }}" disabled readonly>
                        @error('kode_transaksi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">nama_produk</label>
                        <input type="text" name="keranjang_id"
                            class="form-control mb-2  @error('keranjang_id') is-invalid @enderror"
                            value="{{ $transaksis->keranjang->produk->nama_produk }}" disabled readonly>
                        @error('keranjang_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Diskon Voucher</label>
                        <div class="input-group mb-3">
                            @if ($transaksis->voucher == '')
                                <input type="number" name="voucher_id" class="form-control mb-2 " value="0" disabled
                                    readonly>
                            @else
                                <input type="number" name="voucher_id" class="form-control mb-2 "
                                    value="{{ $transaksis->voucher->diskon }}" disabled readonly>
                            @endif
                            <button class="btn btn-secondary mb-2" type="button">%</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">metode_pembayaran</label>
                        <input type="text" name="metode_pembayaran"
                            class="form-control mb-2  @error('metode_pembayaran') is-invalid @enderror"
                            value="{{ $transaksis->metode_pembayaran }}" disabled readonly>
                        @error('metode_pembayaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Waktu pemesanan</label>
                        <input type="text" name="waktu_pemesanan"
                            class="form-control mb-2  @error('waktu_pemesanan') is-invalid @enderror"
                            value="{{ $transaksis->waktu_pemesanan }}" disabled readonly>
                        @error('waktu_pemesanan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ url('/admin/transaksi') }}" class="btn btn-danger me-3"><svg xmlns="http://www.w3.org/2000/svg"
                        width="20" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                    </svg> Kembali</a>
            </div>
        </div>
    </div>
@endsection

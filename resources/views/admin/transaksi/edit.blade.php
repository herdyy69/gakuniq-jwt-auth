@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('transaksi.update', $transaksis->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
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
                                placeholder="Kode transaksi" value="{{ $transaksis->kode_transaksi }}">
                            @error('kode_transaksi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name produk</label>
                            <select name="keranjang_id" class="form-control @error('keranjang_id') is-invalid @enderror">
                                @foreach ($keranjangs as $keranjang)
                                    @if (old('keranjang_id', $keranjang->id) == $transaksis->keranjang->id)
                                        <option value="{{ $keranjang->id }}" selected>{{ $keranjang->produk->nama_produk }}
                                        </option>
                                    @else
                                        <option value="{{ $keranjang->id }}">{{ $keranjang->produk->nama_produk }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('keranjang_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Vouher produk</label>
                            <select name="voucher_id" class="form-control @error('voucher_id') is-invalid @enderror">
                                @foreach ($vouchers as $voucher)
                                    @if ($transaksis->voucher == '')
                                        <option value="" selected>Pilih Voucher</option>
                                        <option value="{{ $voucher->id }}">{{ $voucher->title }}
                                        </option>
                                    @else
                                        @if (old('voucher_id', $voucher->id) == $transaksis->voucher->id)
                                            <option value="{{ $voucher->id }}" selected>{{ $voucher->title }}
                                            </option>
                                            <option value="">Pilih Voucher</option>
                                        @else
                                            <option value="{{ $voucher->id }}">{{ $voucher->title }}
                                            </option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            @error('voucher_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="metode_pembayaran"
                                class="form-control @error('metode_pembayaran') is-invalid @enderror">
                                <option value="{{ $transaksis->metode_pembayaran }}" selected>
                                    {{ $transaksis->metode_pembayaran }}</option>
                                <option value="m-banking">m-banking</option>
                                <option value="dana">dana</option>
                                <option value="gopay">gopay</option>
                                <option value="ovo">ovo</option>
                            </select>
                            @error('metode_pembayaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Waktu pemesanan</label>
                            <input type="date" name="waktu_pemesanan"
                                class="form-control mb-2  @error('waktu_pemesanan') is-invalid @enderror"
                                value="{{ $transaksis->waktu_pemesanan }}">
                            @error('waktu_pemesanan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ url('/admin/transaksi') }}" class="btn btn-danger me-3"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" fill="currentColor"
                            class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                        </svg> Kembali</a>
                    <button type="submit" class="btn btn-primary mx-3">
                        <span class="indicator-label"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                <path
                                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
                            </svg> Kirim </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

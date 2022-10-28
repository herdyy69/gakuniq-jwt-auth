@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    {{-- <form action="{{ route('produk.update', $produks->id) }}" method="post" enctype="multipart/form-data"> --}}
        {{-- @csrf
        @method('put') --}}
        <div class="col-lg-8">
            <div class="card mb-4 shadow-lg rounded card" style="margin: 2%; padding:1% ">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Produk</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Sub Kategori</label>
                        <input type="text" name="sub_kategori_id"
                            class="form-control mb-2  @error('sub_kategori_id') is-invalid @enderror"
                            value="{{ $produks->sub_kategori->sub_kategori }}" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk"
                            class="form-control mb-2  @error('nama_produk') is-invalid @enderror"
                            value="{{ $produks->nama_produk }}" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Produk</label>
                        <input type="number" name="harga"
                            class="form-control mb-2  @error('harga') is-invalid @enderror"
                            value="{{ $produks->harga }}" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok Produk</label>
                        <input type="number" name="stok" class="form-control mb-2  @error('stok') is-invalid @enderror"
                            value="{{ $produks->stok }}" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">diskon Produk</label>
                        <input type="number" name="diskon"
                            class="form-control mb-2  @error('diskon') is-invalid @enderror"
                            value="{{ $produks->diskon }}" disabled readonly>
                    </div>
                    <div class="mb-3">
                        <label class="required form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi" cols="30" rows="7"
                            class="form-control mb-2  @error('deskripsi') is-invalid @enderror" disabled
                            readonly>{{ $produks->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">gambar produk</label>
                        <p>
                            @if (isset($produks) && $produks->gambar_produk1)
                            <img src="{{ asset('images/gambar_produk1/' . $produks->gambar_produk1) }}"
                                class="img-rounded img-responsive"
                                style="width:150px; height:150px; border-radius:10px border-radius:10px" alt="">
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">gambar produk</label>
                        <p>
                            @if (isset($produks) && $produks->gambar_produk2)
                            <img src="{{ asset('images/gambar_produk2/' . $produks->gambar_produk2) }}"
                                class="img-rounded img-responsive" style="width:150px; height:150px; border-radius:10px"
                                alt="">
                            @endif
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">gambar produk</label>
                        <p>
                            <img src="{{ asset('images/gambar_produk3/' . $produks->gambar_produk3) }}"
                                class="img-rounded img-responsive" style="width:150px; height:150px; border-radius:10px"
                                alt="">
                        </p>
                    </div>

                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ url('/admin/produk') }}" class="btn btn-danger me-3"><svg xmlns="http://www.w3.org/2000/svg"
                        width="20" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
                    </svg> Kembali</a>
            </div>
        </div>
        {{--
    </form> --}}
</div>
@endsection
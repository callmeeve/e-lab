@extends('layout.dash')
@include('teknisi_lab.component.navbar')
@section('isi-dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span>Create Barang</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create Barang</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nama_barang">Nama Barang</label>
                            <div class="input-group input-group-merge">
                                <span id="nama-icon" class="input-group-text">
                                    <i class="bx bx-box"></i>
                                </span>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    placeholder="Nama Barang" aria-describedby="nama-icon"
                                    required value="{{ old('nama_barang') ?? '' }}" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="stok">Stok</label>
                            <div class="input-group input-group-merge">
                                <span id="stok-icon" class="input-group-text">
                                    <i class="bx bx-bar-chart"></i>
                                </span>
                                <input type="number" class="form-control" id="stok" name="stok"
                                    placeholder="Stok" aria-describedby="stok-icon"
                                    required value="{{ old('stok') ?? '' }}" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">Image</label>
                            <div class="input-group input-group-merge">
                                <input type="file" class="form-control" id="image" name="image" aria-describedby="image-icon" />
                                <span id="image-icon" class="input-group-text">
                                    <i class="bx bx-image"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="id_kategori">Kategori</label>
                            <select class="form-select" id="id_kategori" name="id_kategori" required>
                                <option selected disabled>Select Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

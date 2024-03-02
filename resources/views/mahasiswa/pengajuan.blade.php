@extends('layout.dash')
@include('mahasiswa.component.navbar')
@section('isi-dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span>Pengajuan Peminjaman Barang Mahasiswa</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('store.pengajuan-mahasiswa') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                            <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" required>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Program Studi</label>
                            <input type="text" class="form-control" id="prodi" name="prodi" required>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                        </div>
                        <div class="mb-3">
                            <label for="barang_id" class="form-label">Barang</label>
                            <select class="form-select" id="barang_id" name="barang_id" required>
                                <option value="" selected disabled>Pilih Barang</option>
                                @foreach($listBarang as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="mb-3">
                            <label for="dosen_approver_id" class="form-label">Nama Dosen Peminjam</label>
                            <select class="form-select" id="dosen_approver_id" name="dosen_approver_id" required>
                                <option value="" selected disabled>Pilih Dosen</option>
                                @foreach($listDosen as $id => $namaDosen)
                                    <option value="{{ $id }}">{{ $namaDosen }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

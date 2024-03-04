@extends('layout.dash')
@include('mahasiswa.component.navbar')
@section('isi-dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Pengajuan Barang Mahasiswa /</span> Menunggu Persetujuan Dosen</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengajuan Barang</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Prodi</th>
                        <th>Jurusan</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @isset($pengajuanBarang)
                        @foreach($pengajuanBarang as $pengajuan)
                        <tr>
                            <td>{{ $pengajuan->id }}</td>              
                            <td>{{ $pengajuan->nama_peminjam }}</td>
                            <td>{{ $pengajuan->prodi }}</td>
                            <td>{{ $pengajuan->jurusan }}</td>
                            <td>{{ $pengajuan->barang->nama_barang }}</td>
                            <td>{{ $pengajuan->jumlah }}</td>
                            <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                            <td>
                                @if($pengajuan->status == 'menunggu_persetujuan_dosen')
                                    <button class="btn btn-warning">Menunggu Persetujuan Dosen</button>
                                @elseif($pengajuan->status == 'menunggu_persetujuan_teknisi')
                                    <button class="btn btn-info">Menunggu Persetujuan Teknisi</button>
                                @elseif($pengajuan->status == 'sudah_tervalidasi')
                                    <button class="btn btn-success">Sudah Tervalidasi</button>
                                @else
                                    <button class="btn btn-danger">Ditolak</button>
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{route('tracking.mahasiswa', $pengajuan->id)}}" class="dropdown-item">
                                            <i class="bx bx-map me-2"></i> Lacak
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">Tidak ada data pengajuan.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <!-- Form Catatan Penolakan -->

    <!--/ Form Catatan Penolakan -->
</div>
@endsection

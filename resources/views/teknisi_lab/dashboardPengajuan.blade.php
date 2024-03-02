@extends('layout.dash')
@include('teknisi_lab.component.navbar')
@section('isi-dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Pengajuan Barang Mahasiswa /</span> Menunggu Persetujuan Teknisi</h4>

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
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <form action="{{ route('setuju.teknisi', $pengajuan->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i
                                                    class="bx bx-check me-2"></i> Setujui</button>
                                        </form>
                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#catatanModal"><i class="bx bx-x me-2"></i> Tolak</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">Tidak ada data pengajuan.</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <!-- Form Catatan Penolakan -->
    <div class="modal fade" id="catatanModal" tabindex="-1" role="dialog" aria-labelledby="catatanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catatanModalLabel">Catatan Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @isset($pengajuan)
                <form action="{{ route('reject.teknisi', $pengajuan->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <textarea class="form-control" id="catatan" name="catatan" rows="3"
                            placeholder="Masukkan catatan penolakan"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Tolak Pengajuan</button>
                    </div>
                </form>
                @endisset
            </div>
        </div>
    </div>
    <!--/ Form Catatan Penolakan -->
</div>
@endsection

@extends('layout.dash')
@include('mahasiswa.component.navbar')

@section('isi-dashboard')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Stepper Content -->
            <div class="col-md-9">
                <h4 class="title">Tracking Pengajuan Anda</h4>
                <ul class="stepper-timeline mt-2">
                    <li class="active">
                        <div class="stepper-head">
                            <span class="stepper-head-icon text-dark">1.</span>
                            <span class="stepper-head-text text-dark">Mengisi Pengajuan Form</span>
                        </div>
                        <div class="stepper-content py-2">
                            <div class="alert alert-success" role="alert">
                                Anda telah mengisi formulir pengajuan.
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="stepper-head">
                            <span class="stepper-head-icon text-dark">2.</span>
                            <span class="stepper-head-text text-dark">Validasi Dosen</span>
                        </div>
                        @if($status == 'menunggu_persetujuan_dosen')
                            <div class="stepper-content py-2">
                                <div class="alert alert-info" role="alert">
                                    Menunggu validasi dari dosen. Harap bersabar.
                                </div>
                            </div>
                        @elseif($status == 'ditolak')
                            <div class="stepper-content py-2">
                                <div class="alert alert-danger" role="alert">
                                    Permintaan Anda Ditolak!
                                    <br>
                                    Catatan : {{$catatan}}
                                </div>
                            </div>
                        @else
                            <div class="stepper-content py-2">
                                <div class="alert alert-success" role="alert">
                                    Permintaan Anda Disetujui Oleh Dosen
                                </div>
                            </div>
                        @endif
                    </li>
                    @if($status != 'menunggu_persetujuan_dosen')
                        <li></li>
                    @else
                        <li>
                            <div class="stepper-head">
                                <span class="stepper-head-icon text-dark">3.</span>
                                <span class="stepper-head-text text-dark">Validasi Teknisi</span>
                            </div>
                            @if($status == 'menunggu_persetujuan_teknisi')
                                <div class="stepper-content py-2">
                                    <div class="alert alert-info" role="alert">
                                        Menunggu validasi dari teknisi. Harap bersabar.
                                    </div>
                                </div>
                            @elseif($status == 'ditolak')
                                <div class="stepper-content py-2">
                                    <div class="alert alert-danger" role="alert">
                                        Permintaan Anda Ditolak!
                                        <br>
                                        Catatan : {{$catatan}}
                                    </div>
                                </div>
                            @elseif($status == 'sudah_tervalidasi')
                            <div class="stepper-content py-2">
                                <div class="alert alert-success" role="alert">
                                    Permintaan Anda Disetujui Oleh Teknisi
                                </div>
                            </div>
                            @endif
                        </li>
                    @endif
                    @if($status == 'sudah_tervalidasi')
                        <li>
                            <div class="stepper-head">
                                <span class="stepper-head-icon text-dark">4.</span>
                                <span class="stepper-head-text text-dark">Unduh Bukti Pengajuan</span>
                            </div>
                            <div class="stepper-content py-2">
                                <div class="alert alert-success" role="alert">
                                    Anda dapat mengunduh bukti pengajuan setelah proses selesai.
                                </div>
                            </div>
                        </li>
                    @endif

                </ul>
            </div>
            <!-- Stepper Content -->
        </div>
        <!-- Row -->
    </div>
    <!-- Container -->
@endsection

@extends('layout.dash')
@include('mahasiswa.component.navbar')
@section('isi-dashboard')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Stepper Content -->
            <div class="col-md-9">
                <h4 class="title">Tracking Pengajuan Anda</h4>
                <ul class="stepper-timeline mt-2">
                    <li>
                        <div class="stepper-head">
                            <span class="stepper-head-icon">1.</span>
                            <span class="stepper-head-text">Mengisi Pengajuan Form</span>
                        </div>
                        <div class="stepper-content py-2">
                            <div class="alert alert-success" role="alert">
                                Anda telah mengisi formulir pengajuan.
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="stepper-head">
                            <span class="stepper-head-icon">2.</span>
                            <span class="stepper-head-text">Validasi Dosen</span>
                        </div>
                        <div class="stepper-content py-2">
                            <div class="alert alert-info" role="alert">
                                Menunggu validasi dari dosen. Harap bersabar.
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="stepper-head">
                            <span class="stepper-head-icon">3.</span>
                            <span class="stepper-head-text">Validasi Teknisi</span>
                        </div>
                        <div class="stepper-content py-2">
                            <div class="alert alert-info" role="alert">
                                Menunggu validasi dari teknisi. Harap bersabar.
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="stepper-head">
                            <span class="stepper-head-icon">4.</span>
                            <span class="stepper-head-text">Unduh Bukti Pengajuan</span>
                        </div>
                        <div class="stepper-content py-2">
                            <div class="alert alert-info" role="alert">
                                Anda dapat mengunduh bukti pengajuan setelah proses selesai.
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Stepper Content -->
        </div>
        <!-- Row -->
    </div>
    <!-- Container -->
@endsection

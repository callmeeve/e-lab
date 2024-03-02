@extends('layout.dash')
@include('mahasiswa.component.navbar')
@section('isi-dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span>Register Mahasiswa</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Registrasi Mahasiswa</h5>
                </div>
                <div class="card-body">
                    @if(isset($mahasiswa))
                        <!-- Show Mahasiswa Profile -->
                        <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
                        <p><strong>Nama:</strong> {{ $mahasiswa->nama_mahasiswa }}</p>
                        <p><strong>Jurusan:</strong> {{ $mahasiswa->jurusan }}</p>
                        <p><strong>Prodi:</strong> {{ $mahasiswa->prodi }}</p>
                        <p><strong>Angkatan:</strong> {{ $mahasiswa->angkatan }}</p>
                    @else
                    <form action="{{ route('mahasiswa.register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nim">NIM</label>
                            <div class="input-group input-group-merge">
                                <span id="nim-icon" class="input-group-text">
                                    <i class="bx bx-user"></i>
                                </span>
                                <input type="number" class="form-control" id="nim" name="nim" placeholder="12345678"
                                    aria-label="12345678" aria-describedby="nim-icon" required value="{{ old('nim') ?? '' }}" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="nama_mahasiswa">Nama Mahasiswa</label>
                            <div class="input-group input-group-merge">
                                <span id="nama-icon" class="input-group-text">
                                    <i class="bx bx-user"></i>
                                </span>
                                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa"
                                    placeholder="John Doe" aria-label="John Doe" aria-describedby="nama-icon"
                                    required value="{{ old('nama_mahasiswa') ?? '' }}" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="jurusan">Jurusan</label>
                            <div class="input-group input-group-merge">
                                <span id="jurusan-icon" class="input-group-text">
                                    <i class="bx bx-building-house"></i>
                                </span>
                                <input type="text" class="form-control" id="jurusan" name="jurusan"
                                    placeholder="Teknik Informatika" aria-label="Teknik Informatika"
                                    aria-describedby="jurusan-icon" required value="{{ old('jurusan') ?? '' }}" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="prodi">Program Studi</label>
                            <div class="input-group input-group-merge">
                                <span id="prodi-icon" class="input-group-text">
                                    <i class="bx bx-book-bookmark"></i>
                                </span>
                                <input type="text" class="form-control" id="prodi" name="prodi"
                                    placeholder="Sistem Informasi" aria-label="Sistem Informasi"
                                    aria-describedby="prodi-icon" required value="{{ old('prodi') ?? '' }}" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="angkatan">Angkatan</label>
                            <div class="input-group input-group-merge">
                                <span id="angkatan-icon" class="input-group-text">
                                    <i class="bx bx-calendar-star"></i>
                                </span>
                                <input type="text" class="form-control" id="angkatan" name="angkatan"
                                    placeholder="2023" aria-label="2023" aria-describedby="angkatan-icon" required value="{{ old('angkatan') ?? '' }}" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

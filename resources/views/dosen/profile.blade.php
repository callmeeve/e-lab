@extends('layout.dash')
@include('dosen.component.navbar')
@section('isi-dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span>Profile Dosen</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Profile Dosen</h5>
                </div>
                <div class="card-body">
                    @if($dosen)
                        <!-- Show Dosen Profile -->
                        <p>Nama Dosen: {{ $dosen->nama_dosen }}</p>
                        <p>NIDN: {{ $dosen->nidn }}</p>
                        <p>Mata Kuliah: {{ $dosen->matakuliah }}</p>
                    @else
                        <!-- Register Dosen Profile -->
                        <form action="{{ route('dosen.registerProfile') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nidn" class="form-label">NIDN</label>
                                <input type="text" class="form-control" id="nidn" name="nidn" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_dosen" class="form-label">Nama Dosen</label>
                                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
                            </div>
                            <div class="mb-3">
                                <label for="matakuliah" class="form-label">Mata Kuliah</label>
                                <input type="text" class="form-control" id="matakuliah" name="matakuliah" required>
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

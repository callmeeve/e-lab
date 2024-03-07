@extends('layout.log')

@section('isi-login')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-2">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('img/poliwangi.png') }}" alt="Brand Logo" />
                            </span>
                            <span class="app-brand-text demo menu-text fw-bold ms-2">E-Lab</span>
                        </a>
                    </div>
                    <p class="text-center mb-5">Mohon untuk login terlebih dahulu</p>
                    <!-- /Logo -->

                    <form id="formAuthentication" class="mb-3" action="{{ route('reset.updatePassword') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                    </form>
                    <p class="text-center">
                        <span>Belum punya akun?</span>
                        <a href="{{ route('mahasiswa.registerAkun') }}">
                            <span>Register</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
@endsection

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
                    <p class="text-center mb-5">Reset Password | Masukan Email Anda!</p>
                    <!-- /Logo -->

                    <form id="formAuthentication" class="mb-3" action="{{ route('reset.sendLink') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus />
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Kirim</button>
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

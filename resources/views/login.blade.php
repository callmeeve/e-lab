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

                    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email atau Nim</label>
                            <input type="text" class="form-control" id="email" name="credential" placeholder="Enter your email or username" autofocus />
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
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

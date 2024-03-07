@extends('layout.dash')
@include('teknisi_lab.component.navbar')
@section('isi-dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Selamat Datang {{$nama}}! 🎉</h5>
                <p class="mb-4">
                  Di E-lab <span class="fw-medium">Poliwangi</span> Selamat Bekerja Teknisi
                </p>

                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="{{asset('img/illustrations/man-with-laptop-light.png')}}"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="{{asset('img/illustrations/man-with-laptop-light.png')}}" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Transactions -->
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{asset('img/icons/unicons/chart-success.png')}}" alt="chart success" class="rounded">
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                  </div>
                </div>
                <span class="fw-medium d-block mb-1">Total Pengajuan</span>
                <h3 class="card-title mb-2">{{$jumlah_pengajuan_masuk}}</h3>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="{{asset('img/icons/unicons/wallet-info.png')}}" alt="Credit Card" class="rounded">
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                  </div>
                </div>
                <span>Pengajuan Perlu Disetujui</span>
                <h3 class="card-title text-nowrap mb-1">{{$jumlah_pengajuan_perlu_disetujui}}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-8 order-2 order-md-3">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-8">
              <h5 class="card-header m-0 me-2 pb-3">Total Pengajuan</h5>
              <div id="totalRevenueChart" class="px-2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

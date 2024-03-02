@extends('layout.dash')
@include('teknisi_lab.component.navbar')
@section('isi-dashboard')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Basic Tables</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <h5 class="card-header d-flex justify-content-between align-items-center">
        Table Basic
        <a href="{{ route('barang.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Barang</a> <!-- Tombol Add Barang dengan ikon + -->
      </h5>
      <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th> <!-- Nomor urut -->
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
          <tbody class="table-border-bottom-0">
            @foreach($barangs as $barang)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Tampilkan nomor urut -->
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->kategori->nama_kategori }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>
                        <img src="{{ asset($barang->image) }}" alt="Image" width="50" height="50">
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('barang.edit', $barang->id) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-2"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
        
        </table>
      </div>
    </div>
    
</div>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangLab;
use App\Models\kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class BarangLabController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $barangs = BarangLab::all();
        return view('teknisi_lab.barang', compact('barangs'),[
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }

    // Method untuk menampilkan form tambah barang dan kategori
    public function create()
    {
        $user = Auth::user();
        $kategoris = kategori::all();
        return view('teknisi_lab.createBarang', compact('kategoris'),[
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }

    // Method untuk menyimpan data barang beserta kategori baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_kategori' => 'nullable|exists:kategori,id'
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension(); // Generate nama unik untuk gambar
            $imagePath = $image->move('public/images/', $imageName); // Simpan gambar ke storage
        }

        // Buat instance baru BarangLab
        $barang = new BarangLab();
        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->id_kategori = $request->id_kategori;
        if (isset($imagePath)) {
            $barang->image = $imagePath;
        }
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Method untuk menampilkan form edit barang dan kategori
    public function edit(BarangLab $barang)
    {
        $user = Auth::user();
        $kategoris = Kategori::all();
        return view('teknisi_lab.editBarang', compact('barang', 'kategoris'),[
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }

    // Method untuk menyimpan perubahan data barang beserta kategori
    public function update(Request $request, BarangLab $barang)
    {
        // Validasi data
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_kategori' => 'nullable|exists:kategori,id'
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension(); // Generate nama unik untuk gambar
            $imagePath = $image->storeAs('images', $imageName); // Simpan gambar ke storage

            // Hapus gambar lama jika ada
            if ($barang->image) {
                Storage::delete($barang->image);
            }

            // Simpan nama file gambar ke dalam database
            $barang->image = $imagePath;
        }

        // Update data barang
        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->id_kategori = $request->id_kategori;
        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    // Method untuk menghapus barang
    public function destroy(BarangLab $barang)
    {
        // Hapus gambar jika ada sebelum menghapus barang
        if ($barang->image) {
            Storage::delete($barang->image);
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}

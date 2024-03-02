<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kategori;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kategoris = Kategori::all();
        return view('teknisi_lab.kategori', compact('kategoris'), [
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $kategoris = Kategori::all();
        return view('teknisi_lab.createKategori', compact('kategoris'),[
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori'
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        $user = Auth::user();
        return view('teknisi_lab.editKategori', compact('kategori'), [
            'nama' => $user->username,
            'email' => $user->email,
        ]);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori,' . $kategori->id
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;

class ProductController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function lihatproduk()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function input()
    {
        return view('input');
    }

    public function barang(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'berat' => 'required|numeric',
            'gambar' => 'required|url',
            'kondisi' => 'required|in:Baru,Bekas',
            'deskripsi' => 'required',
        ]);

        Product::create($validatedData);

        return redirect('/listproduk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function listproduk()
    {
        $products = Product::all();
        return view('listproduk', compact('products'));
    }

    public function update(Request $request, Product $product)
    {

        $validatedData = $request->validate([
            'gambar' => 'required',
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'berat' => 'required|numeric',
            'kondisi' => 'required|in:Baru,Bekas',
            'deskripsi' => 'required',
        ]);



        $product->update($validatedData);


        return redirect()->route('listproduk.barang')->with('success', 'Produk berhasil diupdate');
    }

    public function formedit(Product $product)
    {
        return view('update', compact('product'));
    }

    public function delete($id)
    {

        $product = Product::findOrFail($id);


        $product->delete();


        return redirect()->route('listproduk')->with('success', 'Produk berhasil dihapus');
    }

    public function userProfile()
    {

        $users = User::latest()->get();

        return view('profile', compact('users'));
    }

    public function Profile()
    {

        $user = new User();
        $user->nama = 'Vira';
        $user->email = 'virahasnnaf@gmail.com';
        $user->gender = 'female';
        $user->umur = 20;
        $user->tanggal_lahir = '2002-09-02';
        $user->alamat = 'Jl. Cinta No. 169 kel.Kenangan';
        $user->save();


        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->nama_toko = 'Toko Sllebeww';
        $profile->rate = 5;
        $profile->produk_terbaik = 'Hamster Comell';
        $profile->deskripsi = 'Toko hewan Sllebewww adalah surga bagi para pecinta hewan di kota ini.';
        $profile->save();
    }
}

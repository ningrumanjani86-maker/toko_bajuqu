<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //tampilkan products:
        $products = \App\Models\products::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //menyimpan data
        $request->validate(
            [
                'nama_barang' => 'required',
                'harga' => 'required|numeric',
                'stok' => 'required|numeric',
                'deskripsi' => 'required',  
            ]
        );
        \App\Models\Products::create($request->all());
        return redirect()->route('products.index')->with('success','barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update produk:
        $request->validate(
            [
                'nama_barang' => 'required',
                'harga' => 'required|numeric',
                'stok' => 'required|numeric',
                'deskripsi' => 'required',  
            ]
        );
        //cari produk berdasarkan ID :
        $product=\App\Models\Products::findOrfail($id);
        //update:
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'barang berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data berdasarkan id
        $product=\App\Models\Products::findOrfail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'barang berhasil dihapus');
    }
    // fungsi download pdf
    public function downloadPdf(){
        //ambil semua data tabel products
        $products = \App\Models\products::all();
        //memuat halaman view khusus (html+css) dan gunakan data products
        $pdf = Pdf::loadView('products/product_pdf', compact('products'));
        return $pdf->download('Laporan Data Product Toko bajuqu.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\transaction;
use App\Models\transaction_detail;
use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    //tampilan form transaksi pada index
    public function index(){
        $products = products::where([['stok','>',0]])->get();
        return view('transactions.index', compact('products'));
    }

    public function history(){
        $history = transaction::with('details.product')->latest()->get();
        return view('transactions.history', compact('history'));
    }

    public function store(Request $request){
        $request->validate(
            [
                'product_id'=>'required|exists:products,id',
                'qty'=> 'required|numeric|min:1'
            ]
        );
        //ambil produk dari id yang dipilih
        $products = products::findOrFail($request->product_id);

        //cek apakah stok mencukupi?

        //jika tidak kirim pesan (error)
        if ($products->stok < $request->qty) {
            return back()->withErrors(['qty_error', 'stok tidak mencukupi']);
        }
        //eksekusi simpan transaksi menggunakan DB:transaction
        DB::transaction(function() use($request, $products){
            //create data transaksi
            $subtotal = $products->harga * $request->qty;
            $no_nota = 'TRX - '. strtoupper(uniqid());
            $transaction = transaction::create([
                'no_nota'=>$no_nota,
                'total_harga'=>$subtotal,
            ]);
            //create detail transaksi (tabel transaction_details)
            transaction_detail::create([
                'transaction_id'=>$transaction->id,
                'product_id'=>$products->id,
                'qty'=>$request->qty,
                'harga_satuan'=>$products->harga,
                'subtotal'=>$subtotal,
            ]);

            //potong stok
            $products->decrement('stok',$request->qty);

        });
        //arahkan kembali kehalaman form (dengan menampilkan pesan berhasil)
        return redirect()->route('transactions.index')->with('success', 'transaksi berhasil disimpan');
    }
}

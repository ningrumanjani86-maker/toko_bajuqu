<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @include('navbar')
    <div class="max-w-6xl mx-auto bg-white rounded shadow-sm mt-6">
        <h2 class="text-xl font-bold mb-6 text-gray-800 flex items-center gap-2">
            <span class="material-icons text-red-500">
                history
            </span>Riwayat Transaksi Penjualan
        </h2>
        @if ($history->isEmpty())
            <div class="text-center py-16 text-gray-400">
                <span class="material-icons text-5xl mb-2">receipt_long</span>
                <p>Belum Ada Riwayat Pesanan</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr class="bg-gray-100 text-gray-800">
                            <th class="p-4">Waktu Transaksi</th>
                            <th class="p-4">No Nota</th>
                            <th class="p-4">Daftar Item & QTY</th>
                            <th class="p-4">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700 divide-y">
                        @foreach ($history as $h)
                        <tr>
                            <td class="p-4 text-gray-600"> {{ $h->created_at->format('d M Y - H:i')}} WIB</td>
                            <td class="p-4 text-gray-600"> {{ $h->no_nota}} WIB</td>
                            <td class="p-4">
                                @foreach ($h->details as $detail)
                                <div class="bg-amber-100 text-blue-800 px-2 py-1 rounded">
                                    {{-- tampilkan nama produk, kalau sudah dihapus fallback --}}
                                    {{ $detail->product->nama_barang??'Produk Dihapus' }}
                                    <span class="text-blue-600 font-bold">{{ $detail->qty}}</span>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                Rp. {{ number_format($h->total_harga,0,',','.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @include('navbar')
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow-sm mt-10">
        <h1 class="text-xl font-bold mb-5 text-gray-800 flex items-center gap-2">
            <span class="material-icons text-blue-600">
                shopping_cart
            </span> Input Transaksi
        </h1>
        @if(session('success'))
            <div id="success-alert" class="bg-green-100 border-green-400 text-green-800 px-4 py-2 text-sm mb-4">
                {{ session('success') }}
            </div>
        @endif
        @error('qty_error')
            <div class="bg-red-100 border-red-400 text-red-800 px-4 py-2 text-sm mb-4">
                {{ $message }}
            </div>
        @enderror
        <form action="{{ route('transactions.store') }}" method="post">
            @csrf
            <label for="product_id" class="text-gray-800 block mb-1">Pilih Barang</label>
            <select name="product_id" class="w-full border p-2 mb-4 rounded bg-amber-100 focus:bg-white">
                <option value="">-- Pilih Item --</option>
                @foreach ($products as $p)
                <option value="{{ $p->id }}">
                    {{ $p->nama_barang }} (stok: {{ $p->stok }}) - Rp {{ number_format($p->harga,0,',','.') }}
                </option>
                @endforeach
            </select>
            <label for="qty" class="text-gray-800 block mb-1"></label>
            <input type="number" name="qty" min="1" value="1" class="w-full border p-2 mb-5 rounded bg-amber-100 focus:bg-white">

            <button type="submit" class="bg-blue-600 hover:bg-emerald-600 text-white w-full py-2.5 rounded font-medium">
                <span class="material-icons text-lg">save</span> Simpan Transaksi
            </button>
        </form>
    </div>

    <script>
        // Hilangkan pesan sukses otomatis setelah 3 detik
        setTimeout(function() {
            let alertBox = document.getElementById('success-alert');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 1000);
    </script>
</body>
</html>

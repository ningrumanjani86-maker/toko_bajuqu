<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Item</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4">
    <h1 class="text-2xl font-bold mb-5">Tabel Product Toko BajuQu</h1>
    <button onclick="toggle_modal()" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">+ Tambah Item</button>
    
    <table class="table-auto w-full mt-5">
        <thead>
            <tr class="bg-gray-300">
                <th class="border p-2">Nama Product</th>
                <th class="border p-2">Harga</th>
                <th class="border p-2">Stok</th>
                <th class="border p-2">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td class="border p-2">{{ $p->nama_barang }}</td>
                    <td class="border p-2">Rp. {{ number_format($p->harga,0,',','.') }}</td>
                    <td class="border p-2">{{ $p->stok }}</td>
                    <td class="border p-2">{{ $p->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>    
    </table>

    <div id="modal-tambah-item" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
            <h2 class="text-lg font-bold mb-4">Tambah Item Baru</h2>
            <form action="{{ route('products.store') }}" method="post">
                @csrf
                <label for="nama_barang" class="text-sm">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full border p-2 mb-3 rounded" required>
                
                <label for="harga" class="text-sm">Harga</label>
                <input type="number" name="harga" class="w-full border p-2 mb-3 rounded" required>
                
                <label for="stok" class="text-sm">Stok</label>
                <input type="number" name="stok" class="w-full border p-2 mb-3 rounded" required>
                
                <label for="deskripsi" class="text-sm">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2 mb-3 rounded"></textarea>
                
                <div class="flex justify-end gap-3 mt-2">
                    <button type="button" onclick="toggle_modal()" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggle_modal() {
            const modal = document.getElementById('modal-tambah-item');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>
</body>
</html>

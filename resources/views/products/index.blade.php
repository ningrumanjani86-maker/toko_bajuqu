<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Item</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body class="p-4">
    @include('navbar')

    {{-- Notifikasi login berhasil --}}
    @if(session('success'))
        <div id="alert-success" 
             class="fixed top-5 left-1/2 transform -translate-x-1/2 
                    bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500">
            {{ session('success') }}
        </div>
        <script>
            // otomatis hilang setelah 3 detik
            setTimeout(() => {
                const alertBox = document.getElementById('alert-success');
                if(alertBox){
                    alertBox.style.opacity = '0';
                    setTimeout(() => alertBox.remove(), 500); // hapus elemen setelah fade out
                }
            }, 2000);
        </script>
    @endif

    <div class="flex gap-2 mb-5">
        <button onclick="toggle_modal()" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">+ Tambah Item
            <span class="material-icons"></span>
        </button>
        <a href="{{ route('products.pdf') }}" class="bg-green-500 text-white px-4 py-2 rounded-2xl font-medium flex items-center gap-1 hover:bg-red-700 transition">
            <span class="material-icons text-sm">picture_as_pdf</span>Simpan Sebagai PDF
        </a>
    </div>
    
    <table class="table-auto w-full mt-5">
        <thead>
            <tr class="bg-gray-300">
                <th class="border p-2">Nama Produk</th>
                <th class="border p-2">Harga</th>
                <th class="border p-2">Stok</th>
                <th class="border p-2">Deskripsi</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td class="border p-2">{{ $p->nama_barang }}</td>
                    <td class="border p-2">Rp. {{ number_format($p->harga,0,',','.') }}</td>
                    <td class="border p-2">{{ $p->stok }}</td>
                    <td class="border p-2">{{ $p->deskripsi }}</td>
                    <td class="border p-2">{{ $p->category->name ?? '-' }}</td>
                     <td class="border p-2 text-center">
                        <div class="flex items-center justify-center gap-4">
                            {{-- tombol edit --}}
                            <button onclick="toggle_edit({ id: {{ $p->id }}, nama_barang: '{{ $p->nama_barang }}', harga: {{ $p->harga }}, stok: {{ $p->stok }}, deskripsi: '{{ $p->deskripsi }}', category_id: {{ $p->category_id ?? 'null' }} })" 
                                    class="text-blue-500 hover:text-blue-700">
                                <span class="material-icons">edit</span>
                            </button>

                            {{-- tombol delete pakai modal --}}
                            <button type="button" 
                                    onclick="openDeleteModal('form-delete{{ $p->id }}')" 
                                    class="text-red-600 hover:text-red-800 font-medium">
                                <span class="material-icons">delete</span>
                            </button>

                            <form id="form-delete{{ $p->id }}" action="{{ route('products.destroy', $p->id) }}" method="post" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>    
    </table>

    {{-- modal tambah item --}}
    <div id="modal-tambah-item" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
            <h2 class="text-lg font-bold mb-4">Tambah Item Baru</h2>
            <form action="{{ route('products.store') }}" method="post">
                @csrf
                <label class="text-sm">Nama Barang</label>
                <input type="text" name="nama_barang" class="w-full border p-2 mb-3 rounded" required>
                
                <label class="text-sm">Harga</label>
                <input type="number" name="harga" class="w-full border p-2 mb-3 rounded" required>
                
                <label class="text-sm">Stok</label>
                <input type="number" name="stok" class="w-full border p-2 mb-3 rounded" required>
                
                <label class="text-sm">Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2 mb-3 rounded"></textarea>
                
                <label class="text-sm">Kategori</label>
                <select name="category_id" class="w-full border p-2 mb-3 rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end gap-3 mt-2">
                    <button type="button" onclick="toggle_modal()" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- modal edit item --}}
    <div id="modal-edit-item" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
            <h2 class="text-lg font-bold mb-4">Edit Item</h2>
            <form id="form-edit" method="post">
                @csrf
                @method('PUT')
                <label class="text-sm">Nama Barang</label>
                <input type="text" id="edit_nama_barang" name="nama_barang" class="w-full border p-2 mb-3 rounded" required>
                
                <label class="text-sm">Harga</label>
                <input type="number" id="edit_harga" name="harga" class="w-full border p-2 mb-3 rounded" required>
                
                <label class="text-sm">Stok</label>
                <input type="number" id="edit_stok" name="stok" class="w-full border p-2 mb-3 rounded" required>
                
                <label class="text-sm">Deskripsi</label>
                <textarea id="edit_deskripsi" name="deskripsi" class="w-full border p-2 mb-3 rounded"></textarea>
                
                <label class="text-sm">Kategori</label>
                <select id="edit_category_id" name="category_id" class="w-full border p-2 mb-3 rounded">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <div class="flex justify-end gap-3 mt-2">
                    <button type="button" onclick="document.getElementById('modal-edit-item').classList.replace('flex','hidden')" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-2xl">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- modal konfirmasi delete --}}
    <div id="modal-delete" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-2xl shadow-lg w-96">
            <h2 class="text-lg font-bold mb-4">Apakah ingin dihapus?</h2>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteModal()" 
                        class="bg-red-500 text-white px-4 py-2 rounded">Tidak</button>
                <button type="button" id="confirmDeleteBtn" 
                        class="bg-blue-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        function toggle_modal() {
            const modal = document.getElementById('modal-tambah-item');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
        function toggle_edit(item){
            const modal=document.getElementById('modal-edit-item');
            //mengatur route pada action form dinamis
            document.getElementById('form-edit').action='/products/'+ item.id;
            //mengisi value input form dengan data item yang dipilih:
            document.getElementById('edit_nama_barang').value=item.nama_barang;
            document.getElementById('edit_harga').value=item.harga;
            document.getElementById('edit_stok').value=item.stok;
            document.getElementById('edit_deskripsi').value=item.deskripsi;
            document.getElementById('edit_category_id').value=item.category_id;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
                let deleteFormId = null;

        function openDeleteModal(formId) {
            deleteFormId = formId;
            const modal = document.getElementById('modal-delete');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('modal-delete');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            deleteFormId = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit();
            }
            closeDeleteModal();
        });
    </script>
</body>
</html>
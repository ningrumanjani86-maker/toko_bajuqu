<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6">
    @include('navbar')

    <h2 class="text-2xl font-bold mb-4">Daftar Kategori</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div id="alert-success" 
            class="fixed top-5 left-1/2 transform -translate-x-1/2 
                    bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-500">
            {{ session('success') }}
        </div>
        <script>
            // tampil 3 detik lalu fade out
            setTimeout(() => {
                const alertBox = document.getElementById('alert-success');
                if(alertBox){
                    alertBox.style.opacity = '0'; // mulai fade
                    setTimeout(() => alertBox.remove(), 500); // hapus setelah fade selesai
                }
            }, 2000); // 3000 ms = 3 detik
        </script>
    @endif

    {{-- Tombol tambah kategori --}}
    <button onclick="toggle_modal()" class="bg-blue-500 text-white px-4 py-2 rounded-2xl">+ Tambah Kategori</button>

    {{-- Tabel kategori --}}
    <table class="table-auto w-full mt-5">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Nama Kategori</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td class="border p-2">{{ $category->id }}</td>
                <td class="border p-2">{{ $category->name }}</td>
                <td class="border p-2 text-center">
                    <!-- Tombol Edit -->
                    <button type="button" 
                            onclick="toggle_edit({ id: {{ $category->id }}, name: '{{ $category->name }}' })" 
                            class="mx-1 text-blue-500 hover:text-blue-700">
                        <span class="material-icons">edit</span>
                    </button>

                    <!-- Tombol Delete -->
                    <form id="form-delete{{ $category->id }}" 
                          action="{{ route('categories.destroy', $category->id) }}" 
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                onclick="openDeleteModal('form-delete{{ $category->id }}')" 
                                class="mx-1 text-red-600 hover:text-red-800 font-medium">
                            <span class="material-icons">delete</span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal tambah kategori --}}
    <div id="modal-tambah" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-lg font-bold mb-4">Tambah Kategori</h2>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <input type="text" name="name" class="w-full border p-2 mb-3 rounded" placeholder="Nama Kategori" required>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="toggle_modal()" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal edit kategori --}}
    <div id="modal-edit" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
            <h2 class="text-lg font-bold mb-4">Edit Kategori</h2>
            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="edit_name" name="name" class="w-full border p-2 mb-3 rounded" required>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="toggle_edit_close()" class="text-gray-500">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal konfirmasi delete --}}
    <div id="modal-delete" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-96">
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
        function toggle_modal(){
            const modal = document.getElementById('modal-tambah');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
        function toggle_edit(item){
            const modal = document.getElementById('modal-edit');
            document.getElementById('form-edit').action = '/categories/' + item.id;
            document.getElementById('edit_name').value = item.name;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function toggle_edit_close(){
            document.getElementById('modal-edit').classList.replace('flex','hidden');
        }

        // Konfirmasi delete
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

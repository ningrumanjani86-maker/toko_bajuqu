<nav class="bg-white shadow-sm mb-6">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <div class="w-full px-6 py-3 flex justify-between items-center">
        <div class="flex items-center gap-8">
            <span class="font-bold text-lg text-blue-600 tracking-wide">Toko Bajuqu</span>
            <div class="flex gap-5 text-sm font-medium">

                {{-- menu products --}}
                <a href="{{ route('products.index') }}"
                class="{{ request()->routeIs('products') ?
                'text-blue-500 border-b-2 border-blue-500 pb-1' :
                'text-gray-500 hover:text-blue-500' }}
                flex items-center gap-1">
                <span class="material-icons text-base">inventory_2</span>
                Item
                </a>

                {{-- menu categories --}}
                <a href="{{ route('categories.index') }}"
                class="{{ request()->routeIs('categories.index') ?
                'text-blue-500 border-b-2 border-blue-500 pb-1' :
                'text-gray-500 hover:text-blue-500' }}
                flex items-center gap-1">
                    <span class="material-icons text-base">category</span>
                    Kategori
                </a>

                {{-- menu Transaksi --}}
                <a href="{{ route('transactions.index') }}"
                class="{{ request()->routeIs('transactions.index') ?
                'text-blue-500 border-b-2 border-blue-500 pb-1' :
                'text-gray-500 hover:text-blue-500' }}
                flex items-center gap-1">
                    <span class="material-icons text-base">receipt_long</span>
                    Transaksi
                </a>

                {{-- menu History --}}
                <a href="{{ route('transactions.history') }}"
                class="{{ request()->routeIs('transactions.history') ?
                'text-blue-500 border-b-2 border-blue-500 pb-1' :
                'text-gray-500 hover:text-blue-500' }}
                flex items-center gap-1">
                    <span class="material-icons text-base">history</span>
                    Riwayat
                </a>
            </div>
        </div>
        {{-- logout --}}
        <!-- Tombol Logout -->
        <button type="button" 
                onclick="document.getElementById('logoutModal').classList.remove('hidden')" 
                class="flex items-center gap-1 text-red-500 hover:text-red-700">
            <span class="material-icons">logout</span>
            Keluar
        </button>

        <!-- Modal Konfirmasi -->
        <div id="logoutModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-xl shadow-lg p-6 w-96 animate-fadeIn">
                <h2 class="text-xl font-bold mb-4 text-center text-gray-700">Konfirmasi Logout</h2>
                <p class="mb-6 text-center text-gray-600">Apakah anda yakin ingin keluar?</p>
                <div class="flex justify-center gap-4">
                    <!-- Tombol Tidak (merah) -->
                    <button onclick="document.getElementById('logoutModal').classList.add('hidden')" 
                            class="bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition">
                        Tidak
                    </button>
                    <!-- Tombol Ya, Keluar (biru) -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="bg-blue-500 text-white px-5 py-2 rounded-lg hover:bg-blue-600 transition">
                            Ya, Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Animasi sederhana -->
        <style>
            @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
            }
            .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
            }
        </style>
    </div>
</nav>

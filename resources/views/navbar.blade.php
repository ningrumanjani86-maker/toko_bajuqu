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

                {{-- menu Transaksi --}}
                <a href="#" class="text-gray-500 hover:text-blue-500 flex items-center gap-1 transition">
                    <span class="material-icons text-base">receipt_long</span>
                    Transaksi
                </a>
            </div>
        </div>
        {{-- logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-1 text-red-500 hover:text-red-700">
                <span class="material-icons">logout</span>
                Keluar
            </button>
        </form>
    </div>
</nav>

<html>
    <head>
        <title>Login Toko Bajuqu</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-6 rounded-2xl shadow-md w-80">
            <h2 class="text-2xl font-bold mb-4 text-center">Login Toko Bajuqu</h2>
            
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <label for="email" class="text-sm">Email</label>
                <input type="email" name="email" class="w-full border p-2 mb-3 rounded-2xl" reuired>

                <label for="password" class="text-sm">Password</label>
                <input type="password" name="password" class="w-full border p-2 mb-3 rounded-2xl" reuired>

                <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded-2xl">Login</button>
            </form>
            @error('login_error')
                <p class="text-red-500 text-sm mb-3 text-center">{{ $message }}</p>
            @enderror
        </div>
    </body>
</html>
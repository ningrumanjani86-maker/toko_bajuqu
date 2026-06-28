<html>
    <head>
        <title>Login Toko Bajuqu</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Tambahkan link Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-6 rounded-2xl shadow-md w-80">
            <h2 class="text-2xl font-bold mb-4 text-center">Login Toko Bajuqu</h2>
            
            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <label for="email" class="text-sm">Email</label>
                <input type="email" name="email" 
                       class="w-full border p-2 mb-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                       required>

                <label for="password" class="text-sm">Password</label>
                <div class="relative mb-3">
                    <input type="password" name="password" id="password" 
                           class="w-full border p-2 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           required>
                    <span onclick="togglePassword()" 
                          id="toggleIcon"
                          class="material-icons absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-blue-500 transition-colors">
                        visibility_off
                    </span>
                </div>

                <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded-2xl">Login</button>
            </form>
            @error('login_error')
                <p class="text-red-500 text-sm mb-3 text-center">{{ $message }}</p>
            @enderror
        </div>

        <script>
            function togglePassword() {
                const input = document.getElementById('password');
                const icon = document.getElementById('toggleIcon');
                if (input.type === "password") {
                    input.type = "text";
                    icon.textContent = "visibility"; // mata terbuka → password terlihat
                } else {
                    input.type = "password";
                    icon.textContent = "visibility_off"; // mata tertutup → password disembunyikan
                }
            }
        </script>
    </body>
</html>
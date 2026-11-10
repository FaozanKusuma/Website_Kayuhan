<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kayuhan Street Coffee</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden p-8 space-y-6">
        <div class="text-center space-y-2">
            <h2 class="text-2xl font-bold text-[#1b3b2b]">Kayuhan Street Coffee</h2>
            <p class="text-sm text-gray-500">Silakan masuk ke panel sistem</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1b3b2b] focus:ring-[#1b3b2b] sm:text-sm border p-2.5" placeholder="admin@kayuhan.com">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required autocomplete="current-password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#1b3b2b] focus:ring-[#1b3b2b] sm:text-sm border p-2.5" placeholder="••••••••">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-[#1b3b2b] focus:ring-[#1b3b2b]">
                    <span class="ml-2 text-gray-600">Ingat Saya</span>
                </label>
            </div>

            <!-- Tombol Login -->
            <div>
                <button type="submit" class="w-full bg-[#1b3b2b] hover:bg-[#132a1e] text-white font-medium py-2.5 px-4 rounded-md transition shadow">
                    Masuk
                </button>
            </div>
        </form>
    </div>

</body>
</html>
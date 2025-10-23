<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block mb-2">Email Address</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 bg-gray-700 rounded @error('email') border border-red-500 @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 bg-gray-700 rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Login
            </button>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col min-h-screen">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-3LibEmentxl font-bold text-blue-600">
                <a href="{{ route('welcome') }}"><span class="text-indigo-600">Lib</span>Ement</a>
            </h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Register</a></li>
                    <li><a href="{{ route('login') }}" class="text-blue-600 font-semibold">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-16 px-4 flex-1">
        <div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8 md:p-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Login to Your Account</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                            </div>
                            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
                        </div>
                            @include('layouts.success-message')
                            @include('layouts.error-message')
                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Sign in
                            </button>
                        </div>
                    </div>
                </form>
                <p class="mt-6 text-center text-sm text-gray-500">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Register here
                    </a>
                </p>
            </div>
        </div>
    </main>

    <footer class="mt-16 bg-gray-100 border-t border-gray-200">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center text-gray-600">
                <p>&copy; {{ date('Y') }} Libement System. All rights reserved.</p>
                <p class="mt-2">Empowering knowledge seekers worldwide.</p>
            </div>
        </div>
    </footer>
</body>
</html>
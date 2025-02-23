<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-gray-100 flex flex-col min-h-screen font-sans">
    <header class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-bold">
                <a href="" class="bg-gradient-to-r from-blue-500 to-indigo-500 bg-clip-text text-transparent hover:from-blue-400 hover:to-indigo-400 transition-all">
                    <span>Lib</span>Ement
                </a>
            </h1>
            <nav>
                <ul class="flex space-x-8">
                    <li>
                        <a href="{{ route('register') }}" class="text-blue-400 font-medium hover:text-blue-300 transition-colors">Register</a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors">Login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-12 px-6 flex-1">
        <div class="max-w-md mx-auto bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 shadow-2xl">
            <div class="p-8">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-8">Create Your Account</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                required 
                                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 text-gray-100"
                                placeholder="Enter your full name"
                            >
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required 
                                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 text-gray-100"
                                placeholder="Enter your email"
                            >
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                required 
                                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 text-gray-100"
                                placeholder="Create a password"
                            >
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required 
                                class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 text-gray-100"
                                placeholder="Confirm your password"
                            >
                        </div>
                        <div>
                            <button 
                                type="submit" 
                                class="w-full py-3 px-4 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 rounded-lg text-white font-medium transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900"
                            >
                                Create Account
                            </button>
                        </div>
                    </div>
                </form>
                <p class="mt-8 text-center text-sm text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-blue-400 hover:text-blue-300 transition-colors">
                        Login here
                    </a>
                </p>
            </div>
        </div>
    </main>

    <footer class="mt-16 border-t border-gray-700 bg-gray-800/30">
        <div class="container mx-auto px-6 py-8">
            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Libement System. All rights reserved.</p>
                <p class="mt-2">Empowering knowledge seekers worldwide.</p>
            </div>
        </div>
    </footer>
</body>
</html>
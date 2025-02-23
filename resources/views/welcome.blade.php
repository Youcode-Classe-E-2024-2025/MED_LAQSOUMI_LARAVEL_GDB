<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 flex flex-col min-h-screen">
    <header class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-bold">
                <a href="/" class="bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent hover:opacity-80 transition-all duration-300">
                    <i class="fas fa-book-open mr-2"></i>
                    <span class="font-extrabold">Lib</span>Ement
                </a>
            </h1>
            <nav>
                <ul class="flex items-center space-x-6">
                    <li>
                        <a href="{{ route('register') }}" 
                           class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
                            <i class="fas fa-user-plus mr-2"></i>Register
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" 
                           class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg 
                                  hover:from-blue-600 hover:to-purple-700 transition-all duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-16 px-6 flex-1">
        <div class="max-w-5xl mx-auto bg-gray-800/50 backdrop-blur-lg rounded-2xl border border-gray-700 shadow-xl overflow-hidden md:flex animate-fade-in">
            <div class="md:flex-1 p-8 md:p-12">
                <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent mb-6">
                    Welcome to Our Library
                </h2>
                <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                    Discover a world of knowledge at your fingertips. Our Library Management System 
                    provides easy access to a vast collection of books and resources.
                </p>
                <div class="space-x-4">
                    <a href="{{ route('register') }}" 
                       class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg 
                              hover:from-blue-600 hover:to-purple-700 transition-all duration-300 inline-flex items-center">
                        <i class="fas fa-rocket mr-2"></i>Get Started
                    </a>
                    <a href="{{ route('login') }}" 
                       class="px-6 py-3 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 
                              transition-all duration-300 inline-flex items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>Member Login
                    </a>
                </div>
            </div>
            <div class="md:flex-1 bg-gradient-to-br from-blue-600/20 to-purple-600/20 backdrop-blur-lg p-8 md:p-12 
                        border-l border-gray-700 flex items-center justify-center">
                <div>
                    <h3 class="text-2xl font-bold mb-6 text-transparent bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text">
                        Library Features
                    </h3>
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-search text-blue-400 mr-3"></i>
                            Easy Book Search
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-bookmark text-purple-400 mr-3"></i>
                            Online Reservations
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-laptop text-blue-400 mr-3"></i>
                            Digital Resources
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-list text-purple-400 mr-3"></i>
                            Personal Reading Lists
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-16 bg-gray-800/30 border-t border-gray-700">
        <div class="container mx-auto px-6 py-8">
            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Libement System. All rights reserved.</p>
                <p class="mt-2 text-sm">Empowering knowledge seekers worldwide.</p>
            </div>
        </div>
    </footer>
</body>
</html>
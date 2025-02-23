<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Libement System</title>
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
                    },
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
        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        .mobile-menu-slide {
            animation: slideIn 0.3s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-gray-100 flex flex-col min-h-screen font-sans">
    <header class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">
                <a href="{{ route('dashboard') }}" class="hover:opacity-80 transition-opacity">
                    <i class="fas fa-book-open mr-2"></i>
                    <span class="font-extrabold">Lib</span>Ement
                </a>
            </h1>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="lg:hidden text-gray-300 hover:text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:block">
                <ul class="flex items-center space-x-8">
                    @if($role === 'user')
                        <li><a href="{{route('dashboard')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Books</a></li>
                        <li><a href="{{ route('myBooks', ['user_id' => $user->id]) }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-bookmark mr-2"></i>My Books</a></li>
                        <li><a href="{{route('profile')}}" class="text-blue-400 hover:text-blue-300 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    @elseif($role === 'admin')
                        <li><a href="{{route('dashboard')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-chart-line mr-2"></i>Dashboard</a></li>
                        <li><a href="{{route('manageBooks')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Manage Books</a></li>
                        <li><a href="{{route('manageUsers')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-users mr-2"></i>Manage Users</a></li>
                        <li><a href="{{route('profile')}}" class="text-blue-400 hover:text-blue-300 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    @endif
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden lg:hidden">
            <nav class="flex flex-col space-y-4 px-6 py-4 bg-gray-800/95 backdrop-blur-lg border-b border-gray-700 animate-fade-in">
                @if($role === 'user')
                    <a href="{{route('dashboard')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Books</a>
                    <a href="{{ route('myBooks', ['user_id' => $user->id]) }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-bookmark mr-2"></i>My Books</a>
                    <a href="{{route('profile')}}" class="text-blue-400 hover:text-blue-300 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a>
                @elseif($role === 'admin')
                    <a href="{{route('dashboard')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-chart-line mr-2"></i>Dashboard</a>
                    <a href="{{route('manageBooks')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Manage Books</a>
                    <a href="{{route('manageUsers')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-users mr-2"></i>Manage Users</a>
                    <a href="{{route('profile')}}" class="text-blue-400 hover:text-blue-300 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8">
        <div class="max-w-2xl mx-auto bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 shadow-2xl">
            <div class="p-8">
                <h2 class="text-2xl font-semibold mb-6 text-white flex items-center">
                    <i class="fas fa-user-circle mr-2"></i>Welcome, {{ $name }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="space-y-3">
                        <p class="text-gray-300 flex items-center">
                            <i class="fas fa-envelope mr-2"></i>Email: {{ $email }}
                        </p>
                        <p class="text-gray-300 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>Member since: {{ $created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                @include('layouts.success-message')
                @include('layouts.error-message')

                <form method="POST" action="{{ route('editProfile') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-user mr-2"></i>{{ __('Name') }}
                        </label>
                        <input 
                            id="name" 
                            type="text" 
                            name="name" 
                            value="{{ $name }}" 
                            required 
                            autocomplete="name" 
                            class="w-full px-4 py-3 bg-gray-900/50 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 text-gray-100 @error('name') border-red-500 @enderror"
                        >
                        @error('name')
                            <span class="text-red-400 text-sm mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2"></i>{{ __('Email Address') }}
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ $email }}" 
                            required 
                            autocomplete="email" 
                            class="w-full px-4 py-3 bg-gray-900/50 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 text-gray-100 @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <span class="text-red-400 text-sm mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2"></i>{{ __('Password') }}
                        </label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password" 
                            class="w-full px-4 py-3 bg-gray-900/50 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent placeholder-gray-500 text-gray-100 @error('password') border-red-500 @enderror"
                        >
                        @error('password')
                            <span class="text-red-400 text-sm mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button 
                            type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 rounded-lg text-white font-medium transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900"
                        >
                            <i class="fas fa-save mr-2"></i>{{ __('Update Profile') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="mt-16 border-t border-gray-700 bg-gray-800/30">
        <div class="container mx-auto px-6 py-8">
            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Libement System. All rights reserved.</p>
                <p class="mt-2">Empowering knowledge seekers worldwide.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        let isMenuOpen = false;

        mobileMenuButton.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            mobileMenu.classList.toggle('hidden');
            
            // Update icon
            const icon = mobileMenuButton.querySelector('i');
            icon.classList.remove(isMenuOpen ? 'fa-bars' : 'fa-times');
            icon.classList.add(isMenuOpen ? 'fa-times' : 'fa-bars');
            
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('mobile-menu-slide');
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                mobileMenu.classList.add('hidden');
                isMenuOpen = false;
                const icon = mobileMenuButton.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (isMenuOpen && !mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                mobileMenu.classList.add('hidden');
                isMenuOpen = false;
                const icon = mobileMenuButton.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
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

<body class="bg-gray-900 text-gray-100 flex flex-col min-h-screen">
    <header class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-bold">
                <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent hover:opacity-80 transition-all duration-300">
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
                    <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Books</a></li>
                    <li><a href="" class="text-blue-400 hover:text-blue-300 transition-colors duration-200"><i class="fas fa-bookmark mr-2"></i>My Books</a></li>
                    <li><a href="{{ route('profile') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a></li>
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
            <nav class="flex flex-col space-y-4 px-6 py-4 bg-gray-800/95 backdrop-blur-lg border-b border-gray-700">
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
                    <i class="fas fa-book mr-2"></i>Books
                </a>
                <a href="" class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                    <i class="fas fa-bookmark mr-2"></i>My Books
                </a>
                <a href="{{ route('profile') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
                    <i class="fas fa-user mr-2"></i>Profile
                </a>
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
        <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 shadow-xl overflow-hidden animate-fade-in">
            <div class="px-8 py-6 border-b border-gray-700">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <h2 class="text-2xl font-bold text-transparent bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text">
                        <i class="fas fa-book-reader mr-2"></i>
                        My Borrowed Books
                    </h2>
                    <span class="text-gray-300 bg-gray-700/50 px-4 py-2 rounded-lg">
                        <i class="fas fa-user mr-2"></i>{{ $user->name }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                @if($borrowedBooksByUser->isEmpty())
                    <div class="text-center py-12">
                        <i class="fas fa-books text-gray-500 text-5xl mb-4"></i>
                        <p class="text-gray-400 text-lg mb-6">You haven't borrowed any books yet.</p>
                        <a href="{{ route('dashboard') }}" 
                           class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg 
                                  hover:from-blue-600 hover:to-purple-700 transition-all duration-300 
                                  focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            <i class="fas fa-search mr-2"></i>Browse Books
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($borrowedBooksByUser as $borrow)
                            <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 overflow-hidden hover-scale 
                                      hover:border-blue-500 transform hover:-translate-y-1 transition-all duration-300 shadow-lg">
                                <div class="relative overflow-hidden group">
                                    <img src="{{ $borrow->book->cover }}" 
                                         alt="{{ $borrow->book->title }}" 
                                         class="w-full h-48 object-cover transform group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-100 mb-2 line-clamp-1">{{ $borrow->book->title }}</h3>
                                    <p class="text-gray-400 text-sm mb-2">
                                        <i class="fas fa-user-edit mr-1"></i>
                                        {{ $borrow->book->author }}
                                    </p>
                                    <p class="text-gray-400 text-sm mb-4">
                                        <i class="fas fa-calendar mr-1"></i>
                                        Borrowed: {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d/m/Y') }}
                                    </p>
                                    <div class="flex justify-between items-center">
                                        <a href="{{ route('view-book', ['id' => $borrow->book->id]) }}" 
                                           class="text-blue-400 hover:text-blue-300 transition duration-300">
                                            <i class="fas fa-eye mr-1"></i> View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

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
    </script>
</body>
</html>
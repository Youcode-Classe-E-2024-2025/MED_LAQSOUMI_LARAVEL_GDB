<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details - Libement System</title>
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
    <header class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700">
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
                    <li><a href="" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-bookmark mr-2"></i>My Books</a></li>
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
        <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4 px-6">
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Books</a>
                <a href="" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-bookmark mr-2"></i>My Books</a>
                <a href="{{ route('profile') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8 fade-in">
        <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 shadow-xl overflow-hidden">
            <div class="px-8 py-6 bg-gradient-to-r from-blue-500 to-purple-600 border-b border-gray-700">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-book mr-2"></i>
                    {{ $book->title }}
                </h2>
            </div>
            
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-1">
                        <img src="{{ $book->cover }}" 
                             class="w-full h-auto rounded-xl shadow-xl hover-scale" 
                             alt="Book Cover">
                    </div>
                    <div class="md:col-span-2">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-gray-400 font-semibold">
                                <i class="fas fa-user-edit mr-2"></i>Author
                            </div>
                            <div class="text-gray-300">{{ $book->author }}</div>
                            
                            <div class="text-gray-400 font-semibold">
                                <i class="fas fa-barcode mr-2"></i>ISBN
                            </div>
                            <div class="text-gray-300">{{ $book->isbn }}</div>
                            
                            <div class="text-gray-400 font-semibold">
                                <i class="fas fa-money-bill mr-2"></i>Price
                            </div>
                            <div class="text-gray-300">${{ number_format($book->price, 0) }}</div>
                            
                            <div class="text-gray-400 font-semibold">
                                <i class="fas fa-tag mr-2"></i>Category
                            </div>
                            <div class="text-gray-300">{{ $book->category }}</div>
                            
                            <div class="text-gray-400 font-semibold">
                                <i class="fas fa-calendar-alt mr-2"></i>Published Date
                            </div>
                            <div class="text-gray-300">{{ $book->created_at->format('d/m/Y') }}</div>
                        </div>

                        <div class="mt-8">
                            <h4 class="text-xl font-semibold text-gray-200 mb-3">
                                <i class="fas fa-info-circle mr-2"></i>Description
                            </h4>
                            <p class="text-gray-400 leading-relaxed">{{ $book->description }}</p>
                        </div>

                        <div class="mt-8 flex flex-wrap gap-4">
                            <form action="{{ route('create-borrowed') }}" method="POST" class="flex flex-wrap gap-4">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <select name="user_id" 
                                        class="px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-300 
                                               focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" 
                                        class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg 
                                               hover:from-blue-600 hover:to-purple-700 focus:ring-2 focus:ring-blue-500 
                                               focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300 
                                               flex items-center">
                                    <i class="fas fa-bookmark mr-2"></i> Borrow
                                </button>
                            </form>
                            <a href="{{ route('dashboard') }}" 
                               class="px-6 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 
                                      transition-all duration-300 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Books
                            </a>
                        </div>
                    </div>
                </div>
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
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Libement System</title>
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
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
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
                        @if($role === 'admin')
                            <li><a href="{{route('dashboard')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-chart-line mr-2"></i>Dashboard</a></li>
                            <li><a href="{{route('manageBooks')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Manage Books</a></li>
                            <li><a href="{{route('manageUsers')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-users mr-2"></i>Manage Users</a></li>
                            <li><a href="{{route('profile')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>

            <!-- Mobile Navigation Menu -->
            <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4">
                <nav class="flex flex-col space-y-4">
                    @if($role === 'admin')
                        <a href="{{route('dashboard')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-chart-line mr-2"></i>Dashboard</a>
                        <a href="{{route('manageBooks')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Manage Books</a>
                        <a href="{{route('manageUsers')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-users mr-2"></i>Manage Users</a>
                        <a href="{{route('profile')}}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-4 flex-1">
        <h2 class="text-2xl font-semibold mb-6 text-gray-100">Admin Dashboard</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <!-- System Overview -->
            <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 p-6 animate-fade-in">
                <h3 class="text-xl font-semibold mb-4 text-center bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">System Overview</h3>
                <ul class="space-y-4">
                    <li class="flex justify-between items-center p-3 bg-gray-700/50 rounded-lg hover:bg-gray-700 transition-colors">
                        <span class="text-gray-300"><i class="fas fa-book mr-2"></i>Total Books:</span>
                        <span class="font-semibold text-blue-400 text-lg">{{ count($books) }}</span>
                    </li>
                    <li class="flex justify-between items-center p-3 bg-gray-700/50 rounded-lg hover:bg-gray-700 transition-colors">
                        <span class="text-gray-300"><i class="fas fa-users mr-2"></i>Total Users:</span>
                        <span class="font-semibold text-purple-400 text-lg">{{ count($users) }}</span>
                    </li>
                    <li class="flex justify-between items-center p-3 bg-gray-700/50 rounded-lg hover:bg-gray-700 transition-colors">
                        <span class="text-gray-300"><i class="fas fa-book-reader mr-2"></i>Total Borrowed:</span>
                        <span class="font-semibold text-pink-400 text-lg">{{ count($borrows) }}</span>
                    </li>
                </ul>
            </div>

            <!-- Recent Activities -->
            <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 p-6 animate-fade-in" style="animation-delay: 0.2s">
                <h3 class="text-xl font-semibold mb-4 bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">Recent Activities</h3>
                <ul class="space-y-3">
                    @forelse ($books as $activity)
                        <li class="flex justify-between items-center py-3 border-b border-gray-700 hover:bg-gray-700/50 rounded-lg px-3 transition-colors">
                            <span class="text-gray-300">{{ $activity->description }}</span>
                            <div class="flex flex-col items-end text-sm">
                                <span class="text-gray-400">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $activity->created_at->diffForHumans() }}
                                </span>
                                <span class="text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $activity->updated_at->format('Y-m-d') }}
                                </span>
                            </div>
                        </li>
                    @empty
                        <li class="text-gray-400 text-center py-4">No recent activities.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Recent Books Added -->
        <div class="mt-8 bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 p-6 animate-fade-in" style="animation-delay: 0.4s">
            <h3 class="text-xl font-semibold mb-4 bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">Recently Added Books</h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-4 text-gray-400">Title</th>
                            <th class="text-left py-3 px-4 text-gray-400">Author</th>
                            <th class="text-left py-3 px-4 text-gray-400">ISBN</th>
                            <th class="text-left py-3 px-4 text-gray-400">Added Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr class="hover:bg-gray-700/50 transition-colors">
                                <td class="py-3 px-4 text-gray-300">{{ $book->title }}</td>
                                <td class="py-3 px-4 text-gray-300">{{ $book->author }}</td>
                                <td class="py-3 px-4 text-gray-300">{{ $book->isbn }}</td>
                                <td class="py-3 px-4 text-gray-400">{{ $book->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-400">No books added recently.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="mt-16 bg-gray-800/30 border-t border-gray-700">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Libement System. All rights reserved.</p>
                <p class="mt-2 text-sm">Empowering knowledge seekers worldwide.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            // Add slide animation
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('animate-fade-in');
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
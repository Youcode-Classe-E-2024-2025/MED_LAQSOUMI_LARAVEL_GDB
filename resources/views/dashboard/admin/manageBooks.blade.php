<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
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

<body class="bg-gray-900 text-gray-100 flex flex-col min-h-screen" x-data="{ 
    showModal: false,
    editMode: false,
    bookData: {
        id: '',
        title: '',
        author: '',
        description: '',
        price: '',
        isbn: '',
        cover: ''
    }
}">
    <!-- Enhanced Header -->
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
                    <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-chart-line mr-2"></i>Dashboard</a></li>
                    <li><a href="{{ route('manageBooks') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Manage Books</a></li>
                    <li><a href="{{ route('manageUsers') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-users mr-2"></i>Manage Users</a></li>
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
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-chart-line mr-2"></i>Dashboard</a>
                <a href="{{ route('manageBooks') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Manage Books</a>
                <a href="{{ route('manageUsers') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-users mr-2"></i>Manage Users</a>
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

    <div class="container mx-auto px-6 py-8">
        <!-- Add New Book Button -->
        <div class="mb-6">
            <button @click="showModal = true; editMode = false; bookData = {
                id: '',
                title: '',
                author: '',
                description: '',
                price: '',
                isbn: '',
                cover: ''
            }" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg 
                     hover:from-blue-600 hover:to-purple-700 focus:ring-2 focus:ring-blue-500 
                     focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300">
                <i class="fas fa-plus mr-2"></i>Add New Book
            </button>
        </div>

        <!-- Enhanced Books Table -->
        <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 shadow-xl overflow-hidden animate-fade-in">
            <div class="px-8 py-6 border-b border-gray-700">
                <h4 class="text-xl font-semibold text-gray-100">Manage Books</h4>
                <p class="text-gray-400 mt-1">Total Books: {{ count($books) }}</p>
            </div>
            
            <div class="p-6">
                @include('layouts.success-message')
                @include('layouts.error-message')
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-400">Cover</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-400">Title</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-400">Author</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-400">Price</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 i">
                            @foreach($books ?? [] as $book)
                            <tr class="hover:bg-gray-700/50 transition-all duration-200">
                                <td class="px-6 py-4 flex justify-center">
                                    <img src="{{ $book->cover}}" alt="{{ $book->title }}" 
                                         class="h-20 w-16 object-cover rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300">
                                </td>
                                <td class="px-6 py-4 text-sm text-center text-gray-300 font-medium">{{ $book->title }}</td>
                                <td class="px-6 py-4 text-sm text-center text-gray-400">{{ $book->author }}</td>
                                <td class="px-6 py-4 text-sm text-center text-gray-400">${{ number_format($book->price) }}</td>
                                <td class="px-6 py-4 text-sm text-center">
                                    <div class="flex justify-center space-x-3">
                                        <button @click="
                                            editMode = true;
                                            showModal = true;
                                            bookData = {
                                                id: '{{ $book->id }}',
                                                title: '{{ $book->title }}',
                                                author: '{{ $book->author }}',
                                                description: '{{ $book->description }}',
                                                price: '{{ $book->price }}',
                                                isbn: '{{ $book->isbn }}',
                                                cover: '{{ $book->cover }}'
                                            }
                                        " class="text-blue-400 hover:text-blue-300 transition-colors duration-200">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </button>
                                        <form action="{{ route('delete-book', ['id' => $book->id]) }}" method="GET" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-400 hover:text-red-300 transition-colors duration-200"
                                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                                <i class="fas fa-trash-alt mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal for Add/Edit Book -->
        <div x-show="showModal" 
             class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="bg-gray-800 rounded-xl shadow-2xl w-full max-w-3xl overflow-hidden border border-gray-700"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="transform scale-95"
                 x-transition:enter-end="transform scale-100">
                <div class="border-b border-gray-700 px-8 py-4 flex justify-between items-center">
                    <h4 class="text-xl font-semibold text-gray-100" x-text="editMode ? 'Edit Book' : 'Add New Book'"></h4>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-200 transition duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-8">
                    <form x-bind:action="editMode ? '/books/update/' + bookData.id : '{{ route('create-book') }}'" method="POST" class="max-w-3xl">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-black">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-400 mb-2">Book Title</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    id="title" name="title" x-model="bookData.title" required>
                            </div>
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-400 mb-2">Author</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    id="author" name="author" x-model="bookData.author" required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-400 mb-2">Description</label>
                                <textarea class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    id="description" name="description" rows="4" x-model="bookData.description"></textarea>
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-400 mb-2">Price</label>
                                <input type="number" class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    id="price" name="price" step="0.01" x-model="bookData.price" required>
                            </div>
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-400 mb-2">ISBN</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    id="isbn" name="isbn" minlength="13" maxlength="13" x-model="bookData.isbn" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-400 mb-2">Cover Image</label>
                                <input type="url" name="cover" class="mt-1 w-full px-4 py-2 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    placeholder="Enter image URL" x-model="bookData.cover">
                            </div>
                            <div class="mt-6 flex space-x-4">
                                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg hover:from-blue-600 hover:to-purple-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300" 
                                    x-text="editMode ? 'Update Book' : 'Create Book'"></button>
                                <button type="button" @click="showModal = false" class="px-6 py-2.5 bg-gray-700 text-gray-400 rounded-lg hover:bg-gray-600 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
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

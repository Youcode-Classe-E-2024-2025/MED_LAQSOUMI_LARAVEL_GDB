<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
                    <li><a href="{{ route('myBooks', ['user_id' => $user->id]) }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-bookmark mr-2"></i>My Books</a></li>
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
                <a href="{{ route('myBooks', ['user_id' => $user->id]) }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200">
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

    <main class="container mx-auto px-6 py-8 flex-1">
        <!-- Search Section -->
        <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 p-6 shadow-xl animate-fade-in">
            <h3 class="text-xl font-semibold mb-4 bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">
                <i class="fas fa-search mr-2"></i>Search for Books
            </h3>
            <input type="text" id="query" name="query" 
                   placeholder="Enter book title, author, or ISBN" 
                   class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg 
                          text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 
                          focus:ring-blue-500 focus:border-transparent transition duration-200">
            <div id="searchResults" class="mt-4"></div>
        </div>

        <!-- Books Grid -->
        <div id="booksContainer" class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        </div>

        @if (isset($books) && $books->count() === 0)
            <div class="mt-8 bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 p-6 shadow-xl animate-fade-in">
                <p class="text-gray-400 text-center">
                    <i class="fas fa-book-open text-4xl mb-4 block"></i>
                    No books found matching your search criteria.
                </p>
            </div>
        @endif
    </main>

    <footer class="mt-16 bg-gray-800/30 border-t border-gray-700">
        <div class="container mx-auto px-6 py-8">
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

        // Update book card template with enhanced styling
        const createBookElement = (book) => `
            <a href="/books/view/${book.id}" class="block hover-scale">
                <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 shadow-xl 
                           hover:border-blue-500 transform hover:-translate-y-1 transition-all duration-300">
                    <div class="relative overflow-hidden rounded-t-xl">
                        <img src="${book.cover}" alt="${book.title}" 
                             class="w-full h-72 object-cover transform hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-0 
                                  hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6 space-y-3">
                        <h4 class="text-xl font-bold text-gray-100 hover:text-blue-400 
                                 transition-colors line-clamp-1">${book.title}</h4>
                        <p class="text-gray-400 font-medium">By ${book.author}</p>
                        <div class="pt-2 space-y-2">
                            <p class="text-sm flex items-center">
                                <span class="font-medium mr-2 text-gray-400">ISBN:</span> 
                                <span class="text-gray-300">${book.isbn}</span>
                            </p>
                            <p class="text-sm flex items-center">
                                <span class="font-medium mr-2 text-gray-400">Published:</span>
                                <span class="text-gray-300">${new Date(book.created_at).toLocaleDateString()}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        `;

        // Update your error messages to match the dark theme
        const errorTemplate = '<p class="text-red-400">An error occurred while fetching the books.</p>';
        const noResultsTemplate = '<p class="text-gray-400">No books found matching your search criteria.</p>';

        document.querySelector('#query').addEventListener('input', function(e) {
            let query = e.target.value;
            let booksContainer = document.querySelector('#booksContainer');
            booksContainer.innerHTML = '';  

            if (query.length > 0) {

                fetch(`/book/search/${query}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length === 0) {
                            booksContainer.innerHTML = noResultsTemplate;
                        } else {
                            data.forEach(book => {
                                let bookElement = document.createElement('div');
                                bookElement.innerHTML = createBookElement(book);
                                booksContainer.appendChild(bookElement);
                            });
                        }
                    })
                    .catch(error => {
                        booksContainer.innerHTML = errorTemplate;
                    });
            } else {

                fetch(`{{ route('booksJson') }}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(book => {
                            let bookElement = document.createElement('div');
                            bookElement.innerHTML = createBookElement(book);
                            booksContainer.appendChild(bookElement);
                        });
                    })
                    .catch(error => {
                        booksContainer.innerHTML = errorTemplate;
                    });
            }
        }); 


        document.addEventListener('DOMContentLoaded', function() {
            fetch(`{{ route('booksJson') }}`)
                .then(response => response.json())
                .then(data => {
                    let booksContainer = document.querySelector('#booksContainer');
                    data.forEach(book => {
                        let bookElement = document.createElement('div');
                        bookElement.innerHTML = createBookElement(book);
                        booksContainer.appendChild(bookElement);
                    });
                })
                .catch(error => {
                    let booksContainer = document.querySelector('#booksContainer');
                    booksContainer.innerHTML = errorTemplate;
                });
        });
    </script>
</body>
</html>

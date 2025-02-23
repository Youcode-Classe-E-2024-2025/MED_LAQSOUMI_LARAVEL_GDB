<!DOCTYPE html>
<html lang="en">

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
    </style>
</head>

<body class="bg-gray-900 text-gray-100 flex flex-col min-h-screen">
    <header class="bg-gray-800 border-b border-gray-700">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent">
                <a href="{{ route('dashboard') }}" class="hover:opacity-80 transition-opacity">
                    <span class="font-extrabold">Lib</span>Ement
                </a>
            </h1>
            <nav>
                <ul class="flex items-center space-x-8">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Books</a></li>
                    <li><a href="{{ route('myBooks', ['user_id' => $user->id]) }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-bookmark mr-2"></i>My Books</a></li>
                    <li><a href="{{ route('profile') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors duration-200"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-4 flex-1">
        <div class="mt-8 bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
            <h3 class="text-xl font-semibold mb-4 text-gray-100">Search for Books</h3>
            <input type="text" id="query" name="query" placeholder="Enter book title, author, or ISBN" 
                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
            <div id="searchResults" class="mt-4"></div>
        </div>

        <div id="booksContainer" class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        </div>

        @if (isset($books) && $books->count() === 0)
            <div class="mt-8 bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
                <p class="text-gray-400">No books found matching your search criteria.</p>
            </div>
        @endif
    </main>

    <footer class="mt-16 bg-gray-800 border-t border-gray-700">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Libement System. All rights reserved.</p>
                <p class="mt-2 text-sm">Empowering knowledge seekers worldwide.</p>
            </div>
        </div>
    </footer>

    <script>
        // Update your book element template to match the dark theme
        const createBookElement = (book) => `
            <a href="/books/view/${book.id}" class="block">
                <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700 hover:border-blue-500 
                           transform hover:-translate-y-1 transition-all duration-300">
                    <div class="relative overflow-hidden rounded-lg mb-4">
                        <img src="${book.cover}" alt="${book.title}" 
                             class="w-full h-72 object-cover transform hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="space-y-3">
                        <h4 class="text-xl font-bold text-gray-100 hover:text-blue-400 transition-colors">${book.title}</h4>
                        <p class="text-gray-400 font-medium">By ${book.author}</p>
                        <div class="pt-2 space-y-2">
                            <p class="text-sm text-gray-500 flex items-center">
                                <span class="font-medium mr-2 text-gray-400">ISBN:</span> 
                                <span class="text-gray-300">${book.isbn}</span>
                            </p>
                            <p class="text-sm text-gray-500 flex items-center">
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

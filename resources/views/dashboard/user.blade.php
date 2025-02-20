<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head section remains the same -->
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-blue-600">
                <a href="{{ route('dashboard') }}"><span class="text-indigo-600">Lib</span>Ement</a>
            </h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Books</a></li>
                    <li><a href="{{ route('my.books') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">My Books</a></li>
                    <li><a href="{{ route('profile') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600 transition duration-300">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-4 flex-1">
        @include('layouts.success-message')
        
        <!-- Display User Information -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Welcome, {{ auth()->user()->name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Email: {{ auth()->user()->email }}</p>
                    <p class="text-gray-600">Member since: {{ auth()->user()->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Book Search -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Search for Books</h3>
            <form action="{{ route('books.search') }}" method="GET" class="flex gap-4">
                <input type="text" 
                       name="query" 
                       value="{{ request('query') }}"
                       placeholder="Enter book title, author, or ISBN" 
                       class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Search</button>
            </form>
        </div>

        <!-- Search Results -->
        @if(isset($books) && $books->count() > 0)
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($books as $book)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="font-semibold">{{ $book->title }}</h4>
                <p class="text-gray-600">By {{ $book->author }}</p>
                <p class="text-gray-500">ISBN: {{ $book->isbn }}</p>
                <div class="mt-4">
                    <a href="{{ route('books.show', $book->id) }}" 
                       class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        {{ $books->links() }}
        @elseif(request('query'))
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <p class="text-gray-600">No books found matching your search criteria.</p>
        </div>
        @endif
    </main>

    <footer class="mt-16 bg-gray-100 border-t border-gray-200">
        <!-- Footer section remains the same -->
    </footer>
</body>
</html>
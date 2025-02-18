<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-blue-600">
                <a href="{{ route('home') }}"><span class="text-indigo-600">Lib</span>Ement</a>
            </h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('user.books') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">My Books</a></li>
                    <li><a href="{{ route('user.profile') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">Profile</a></li>
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
        <h2 class="text-2xl font-semibold mb-6">Welcome, {{ Auth::user()->name }}</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Currently Borrowed Books -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Currently Borrowed Books</h3>
                <ul class="space-y-2">
                    @forelse ($borrowedBooks as $book)
                        <li class="flex justify-between items-center">
                            <span>{{ $book->title }}</span>
                            <span class="text-sm text-gray-500">Due: {{ $book->due_date }}</span>
                        </li>
                    @empty
                        <li>No books currently borrowed.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Reading List -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">My Reading List</h3>
                <ul class="space-y-2">
                    @forelse ($readingList as $book)
                        <li>{{ $book->title }}</li>
                    @empty
                        <li>Your reading list is empty.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Recent Activity</h3>
                <ul class="space-y-2">
                    @forelse ($recentActivities as $activity)
                        <li class="text-sm">
                            <span class="font-medium">{{ $activity->action }}</span>
                            <span class="text-gray-500">{{ $activity->created_at->diffForHumans() }}</span>
                        </li>
                    @empty
                        <li>No recent activity.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Book Search -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Search for Books</h3>
            <form action="{{ route('user.search') }}" method="GET" class="flex gap-4">
                <input type="text" name="query" placeholder="Enter book title, author, or ISBN" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Search</button>
            </form>
        </div>
    </main>

    <footer class="mt-16 bg-gray-100 border-t border-gray-200">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center text-gray-600">
                <p>&copy; {{ date('Y') }} Libement System. All rights reserved.</p>
                <p class="mt-2">Empowering knowledge seekers worldwide.</p>
            </div>
        </div>
    </footer>
</body>
</html>
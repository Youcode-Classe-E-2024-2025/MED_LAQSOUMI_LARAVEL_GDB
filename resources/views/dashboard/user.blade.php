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
                <a href="{{ route('dashboard') }}"><span class="text-indigo-600">Lib</span>Ement</a>
            </h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('dashboard') }}"
                            class="text-gray-600 hover:text-blue-600 transition duration-300">Books</a></li>
                    {{-- <li><a href="{{ route('my.books') }}" class="text-gray-600 hover:text-blue-600 transition duration-300">My Books</a></li> --}}
                    <li><a href="{{ route('profile') }}"
                            class="text-gray-600 hover:text-blue-600 transition duration-300">Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-gray-600 hover:text-blue-600 transition duration-300">Logout</button>
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
            <h2 class="text-2xl font-semibold mb-4">Welcome, {{ $name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Email: {{ $email }}</p>
                    <p class="text-gray-600">Member since: {{ $created_at->format(' d/m/Y ') }}</p>
                </div>
            </div>
        </div>

        @include('dashboard.booksSearch')
        @include('dashboard.booksDisplay')
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

<!DOCTYPE html>
<html lang="en">

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
            from { opacity: 0; }
            to { opacity: 1; }
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
                    <li><a href="" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-bookmark mr-2"></i>My Books</a></li>
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

    <div class="container mx-auto px-4 py-8">
        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-100">
                    <i class="fas fa-book-reader mr-2 text-blue-400"></i>
                    My Borrowed Books
                </h2>
                <span class="text-gray-300">
                    <i class="fas fa-user mr-2"></i>{{ $user->name }}
                </span>
            </div>

            @if($borrowedBooksByUser->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-books text-gray-500 text-5xl mb-4"></i>
                    <p class="text-gray-400 text-lg">You haven't borrowed any books yet.</p>
                    <a href="{{ route('dashboard') }}" 
                       class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 
                              transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        Browse Books
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($borrowedBooksByUser as $borrow)
                        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden hover-scale 
                                  hover:border-blue-500 transform hover:-translate-y-1 transition-all duration-300">
                            <img src="{{ $borrow->book->cover }}" 
                                 alt="{{ $borrow->book->title }}" 
                                 class="w-full h-48 object-cover transform hover:scale-105 transition-transform duration-300">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-100 mb-2">{{ $borrow->book->title }}</h3>
                                <p class="text-gray-400 text-sm mb-2">
                                    <i class="fas fa-user-edit mr-1"></i>
                                    {{ $borrow->book->author }}
                                </p>
                                <p class="text-gray-400 text-sm mb-2">
                                    <i class="fas fa-calendar mr-1"></i>
                                    Borrowed: {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d/m/Y') }}
                                </p>
                                <div class="mt-4 flex justify-between items-center">
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
</body>
</html>
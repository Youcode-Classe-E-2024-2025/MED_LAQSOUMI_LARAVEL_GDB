<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

<body class="bg-gray-50 flex flex-col min-h-screen">
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-blue-600 hover-scale">
                <a href="{{ route('dashboard') }}">
                    <i class="fas fa-book-reader mr-2"></i>
                    <span class="text-indigo-600">Lib</span>Ement
                </a>
            </h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="{{ route('dashboard') }}"
                            class="text-gray-600 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-book mr-1"></i> Books</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-bookmark mr-1"></i> My Books</a></li>
                    <li><a href="{{ route('profile') }}"
                            class="text-gray-600 hover:text-blue-600 transition duration-300">
                            <i class="fas fa-user mr-1"></i> Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-gray-600 hover:text-red-600 transition duration-300">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl p-6 fade-in">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-book-reader mr-2 text-blue-600"></i>
                    My Borrowed Books
                </h2>
                <span class="text-gray-600">
                    <i class="fas fa-user mr-2"></i>{{ $user->name }}
                </span>
            </div>

            @if($borrowedBooksByUser->isEmpty())
                <div class="text-center py-12">
                    <i class="fas fa-books text-gray-400 text-5xl mb-4"></i>
                    <p class="text-gray-500 text-lg">You haven't borrowed any books yet.</p>
                    <a href="{{ route('dashboard') }}" 
                       class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                        Browse Books
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($borrowedBooksByUser as $borrow)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover-scale border border-gray-200">
                            <img src="{{ $borrow->book->cover }}" 
                                 alt="{{ $borrow->book->title }}" 
                                 class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $borrow->book->title }}</h3>
                                <p class="text-gray-600 text-sm mb-2">
                                    <i class="fas fa-user-edit mr-1"></i>
                                    {{ $borrow->book->author }}
                                </p>
                                <p class="text-gray-600 text-sm mb-2">
                                    <i class="fas fa-calendar mr-1"></i>
                                    Borrowed: {{ \Carbon\Carbon::parse($borrow->borrowed_at)->format('d/m/Y') }}
                                </p>
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('view-book', ['id' => $borrow->book->id]) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition duration-300">
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
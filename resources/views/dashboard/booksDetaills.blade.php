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
                            <i class="fas fa-books mr-1"></i> Books</a></li>
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

    <div class="container mx-auto px-4 py-8 fade-in">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden hover-scale">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <i class="fas fa-book mr-2"></i>
                    {{ $book->title }}
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-1">
                        <img src="{{ $book->cover }}" 
                             class="w-full h-auto rounded-lg shadow-lg hover-scale" 
                             alt="Book Cover">
                    </div>
                    <div class="md:col-span-2">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-gray-600 font-semibold">
                                <i class="fas fa-user-edit mr-2"></i>Author
                            </div>
                            <div class="text-gray-800">{{ $book->author }}</div>
                            
                            <div class="text-gray-600 font-semibold">
                                <i class="fas fa-barcode mr-2"></i>ISBN
                            </div>
                            <div class="text-gray-800">{{ $book->isbn }}</div>
                            <div class="text-gray-600 font-semibold">
                                <i class="fas fa-money-bill mr-2"></i>Price
                            </div>
                            <div class="text-gray-800">{{ number_format($book->price, 0) }} $</div>
                            <div class="text-gray-600 font-semibold">
                                <i class="fas fa-tag mr-2"></i>Category
                            </div>
                            <div class="text-gray-800">{{ $book->category }}</div>
                            
                            <div class="text-gray-600 font-semibold">
                                <i class="fas fa-calendar-alt mr-2"></i>Published Date
                            </div>
                            <div class="text-gray-800">{{ $book->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="mt-8">
                            <h4 class="text-xl font-semibold text-gray-800 mb-3">
                                <i class="fas fa-info-circle mr-2"></i>Description
                            </h4>
                            <p class="text-gray-600 leading-relaxed">{{ $book->description }}</p>
                        </div>


                        <div class="mt-8 flex space-x-4">
                            <form action="{{ route('create-borrowed') }}" method="POST">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <select name="user_id" class="mr-4 px-4 py-2 border rounded-md">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300 flex items-center">
                                    <i class="fas fa-bookmark mr-2"></i> Borrow
                                </button>
                            </form>
                            <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-300 flex items-center">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Books
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
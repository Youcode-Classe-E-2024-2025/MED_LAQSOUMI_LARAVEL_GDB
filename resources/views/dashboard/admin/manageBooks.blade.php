<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen" x-data="{ 
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
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold">
                <a href="" class="flex items-center space-x-2">
                    <span class="text-indigo-600">Lib</span>
                    <span class="text-gray-800">Ement</span>
                </a>
            </h1>
            <nav>
                <ul class="hidden lg:flex items-center space-x-8">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-chart-line mr-2"></i>Dashboard</a></li>
                    <li><a href="{{ route('manageBooks') }}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-book mr-2"></i>Manage Books</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-users mr-2"></i>Manage Users</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-file-alt mr-2"></i>Reports</a></li>
                    <li><a href="/profile" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8">
        <!-- Add New Book Button -->
        <div class="mb-4">
            <button @click="showModal = true; editMode = false; bookData = {
                id: '',
                title: '',
                author: '',
                description: '',
                price: '',
                isbn: '',
                cover: ''
            }" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all">Add New Book</button>
        </div>
        <!-- Enhanced Add/Edit Book Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-sm w-full max-w-3xl overflow-hidden">
                <div class="border-b px-8 py-4 flex justify-between items-center">
                    <h4 class="text-xl font-semibold text-gray-800" x-text="editMode ? 'Edit Book' : 'Add New Book'"></h4>
                    <button @click="showModal = false" class="text-gray-600 hover:text-gray-800 transition duration-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-8">
                    <form x-bind:action="editMode ? '/books/update/' + bookData.id : '{{ route('create-book') }}'" method="POST" class="max-w-3xl">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Book Title</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="title" name="title" x-model="bookData.title" required>
                            </div>
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="author" name="author" x-model="bookData.author" required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="description" name="description" rows="4" x-model="bookData.description"></textarea>
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                                <input type="number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="price" name="price" step="0.01" x-model="bookData.price" required>
                            </div>
                            <div>
                                <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">ISBN</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="isbn" name="isbn" minlength="13" maxlength="13" x-model="bookData.isbn" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                                <input type="url" name="cover" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    placeholder="Enter image URL" x-model="bookData.cover">
                            </div>
                            <div class="mt-6 flex space-x-4">
                                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all" 
                                    x-text="editMode ? 'Update Book' : 'Create Book'"></button>
                                <button type="button" @click="showModal = false" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 transition-all">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Enhanced Books Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b">
                <h4 class="text-xl font-semibold text-gray-800">Manage Books</h4>
                <h4 class="text-md font-semibold text-gray-800">Total : {{ count($books) }}</h4>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    @include('layouts.success-message')
                    @include('layouts.error-message')
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-center text-md font-semibold text-gray-600">Cover</th>
                                <th class="px-6 py-4 text-center text-md font-semibold text-gray-600">Title</th>
                                <th class="px-6 py-4 text-center text-md font-semibold text-gray-600">Author</th>
                                <th class="px-6 py-4 text-center text-md font-semibold text-gray-600">Price</th>
                                <th class="px-6 py-4 text-center text-md font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 i">
                            @foreach($books ?? [] as $book)
                            <tr class="hover:bg-gray-50 transition-all">
                                <td class="px-6 py-4 flex justify-center">
                                    <img src="{{ $book->cover}}" alt="{{ $book->title }}" 
                                         class="h-20 w-16 object-cover rounded-lg shadow-sm bg-center bg-contain">
                                </td>
                                <td class="px-6 py-4 text-sm text-center text-gray-800 font-medium">{{ $book->title }}</td>
                                <td class="px-6 py-4 text-sm text-center text-gray-600">{{ $book->author }}</td>
                                <td class="px-6 py-4 text-sm text-center text-gray-600">${{ number_format($book->price) }}</td>
                                <td class="px-6 py-4 text-sm text-center text-gray-600">
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
                                        " class="text-blue-600 hover:text-blue-800 mr-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('delete-book', ['id' => $book->id]) }}" method="GET" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 text-md font-medium text-red-600 flex items-center"
                                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                                <i class="fas fa-trash-alt mr-2"></i>
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
    </div>
</body>
</html>

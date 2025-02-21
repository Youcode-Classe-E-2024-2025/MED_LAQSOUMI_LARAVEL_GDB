<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Enhanced Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold">
                <a href="" class="flex items-center space-x-2">
                    <span class="text-indigo-600">Lib</span>
                    <span class="text-gray-800">Ement</span>
                    <span class="text-sm font-medium text-gray-500">Admin</span>
                </a>
            </h1>
            <nav>
                <ul class="hidden lg:flex items-center space-x-8">
                    <li><a href="/dashboard" class="text-gray-600 hover:text-indigo-600 font-medium transition-all">Dashboard</a></li>
                    <li><a href="/manageBooks" class="text-gray-600 hover:text-indigo-600 font-medium transition-all">Manage Books</a></li>
                    <li><a href="" class="text-gray-600 hover:text-indigo-600 font-medium transition-all">Manage Users</a></li>
                    <li><a href="" class="text-gray-600 hover:text-indigo-600 font-medium transition-all">Reports</a></li>
                    <li><a href="/profile" class="text-gray-600 hover:text-indigo-600 font-medium transition-all">Profile</a></li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-all">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8">
        <!-- Enhanced Add New Book Form -->
        <div class="bg-white rounded-xl shadow-sm mb-8 overflow-hidden">
            <div class="border-b px-8 py-4">
                <h4 class="text-xl font-semibold text-gray-800">Add New Book</h4>
            </div>
            <div class="p-8">
                <form action="" method="POST" enctype="multipart/form-data" class="max-w-3xl">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Book Title</label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" id="title" name="title" required>
                        </div>

                        <div>
                            <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                            <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" id="author" name="author" required>
                        </div>

                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" id="description" name="description" rows="4"></textarea>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                            <input type="number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" id="price" name="price" step="0.01" required>
                        </div>

                        <div>
                            <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                            <input type="file" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" id="cover_image" name="cover_image">
                        </div>
                    </div>

                    <div class="mt-6 flex space-x-4">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all">Create Book</button>
                        <a href="" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 transition-all">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Enhanced Books Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b">
                <h4 class="text-xl font-semibold text-gray-800">Manage Books</h4>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Cover</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Title</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Author</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Price</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($books ?? [] as $book)
                            <tr class="hover:bg-gray-50 transition-all">
                                <td class="px-6 py-4">
                                    <img src="{{ $book->cover ?? 'default-cover.jpg' }}" alt="Cover" 
                                         class="h-20 w-16 object-cover rounded-lg shadow-sm">
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $book->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $book->author ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">${{ number_format($book->price ?? 0, 2) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-all">
                                           Edit
                                        </a>
                                        <form action="" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-all"
                                                    onclick="return confirm('Are you sure you want to delete this book?')">
                                                Delete
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

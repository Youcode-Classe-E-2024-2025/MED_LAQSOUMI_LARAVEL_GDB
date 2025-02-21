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
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-blue-600">
                <a href="" class="hover:opacity-80 transition-opacity"><span class="text-indigo-600">Lib</span>Ement Admin</a>
            </h1>
            <nav>
                <div class="block lg:hidden">
                    <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-600 border-gray-600 hover:text-blue-600 hover:border-blue-600">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                        </svg>
                    </button>
                </div>
                <ul id="nav-content" class="hidden lg:flex space-x-6">
                    <li><a href="/dashboard" class="text-gray-600 hover:text-blue-600 transition duration-300">Dashboard</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300">Manage Books</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300">Manage Users</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300">Reports</a></li>
                    <li><a href="/profile" class="text-gray-600 hover:text-blue-600 transition duration-300">Profile</a></li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600 transition duration-300">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="border-b pb-4 mb-6">
                <h4 class="text-2xl font-semibold text-gray-800">Add New Book</h4>
            </div>
            <div class="max-w-2xl">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Book Title</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="title" name="title" required>
                    </div>

                    <div class="mb-6">
                        <label for="author" class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="author" name="author" required>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="description" name="description" rows="4"></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="price" name="price" step="0.01" required>
                    </div>

                    <div class="mb-6">
                        <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-2">Cover Image</label>
                        <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="cover_image" name="cover_image">
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">Create Book</button>
                        <a href="" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
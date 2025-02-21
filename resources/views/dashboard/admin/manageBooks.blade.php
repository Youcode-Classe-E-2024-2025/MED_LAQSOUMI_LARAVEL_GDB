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
                <a href=""><span class="text-indigo-600">Lib</span>Ement Admin</a>
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
                    <li><a href="/manageBooks" class="text-gray-600 hover:text-blue-600 transition duration-300">Manage Books</a></li>
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
        <!-- Add New Book Form -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="border-b pb-4 mb-6">
                <h4 class="text-2xl font-semibold text-gray-800">Add New Book</h4>
            </div>
            <div class="max-w-2xl">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- ... [form fields remain the same] ... -->
                </form>
            </div>
        </div>

        <!-- Books Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="border-b pb-4 mb-6">
                <h4 class="text-2xl font-semibold text-gray-800">Manage Books</h4>
            </div>
            
            <!-- Search and Filter -->
            <div class="mb-4 flex justify-between items-center">
                <div class="flex gap-4">
                    <input type="text" placeholder="Search books..." class="px-4 py-2 border rounded-md">
                    <select class="px-4 py-2 border rounded-md">
                        <option value="">All Categories</option>
                        <option value="fiction">Fiction</option>
                        <option value="non-fiction">Non-Fiction</option>
                    </select>
                </div>
            </div>

            <!-- Books Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cover</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($books ?? [] as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ $book->cover_image ?? 'default-cover.jpg' }}" alt="Cover" class="h-12 w-12 object-cover rounded">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->title ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $book->author ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">${{ number_format($book->price ?? 0, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <a href="" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                                    <form action="" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{-- <div class="mt-4">
                {{ $books->links() ?? '' }}
            </div> --}}
        </div>
    </div>
</body>
</html>

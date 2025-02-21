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
                <ul class="flex space-x-6">
                    <li><a href="/dashboard" class="text-gray-600 hover:text-blue-600 transition duration-300">Dashboard</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300">Manage Books</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300">Manage Users</a></li>
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300">Reports</a></li>
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

    <main class="container mx-auto mt-8 px-4 flex-1">
        <h2 class="text-2xl font-semibold mb-6">Admin Dashboard</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- System Overview -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-center text-blue-600">System Overview</h3>
                <ul class="space-y-4">
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                        <span class="text-gray-600">Total Books:</span>
                        <span class="font-semibold text-blue-600 text-lg">{{ count($books) }}</span>
                    </li>
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                        <span class="text-gray-600">Total Users:</span>
                        <span class="font-semibold text-green-600 text-lg">{{ count($user) }}</span>
                    </li>
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                        <span class="text-gray-600">Books Borrowed:</span>
                        <span class="font-semibold text-purple-600 text-lg"></span>
                    </li>
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                        <span class="text-gray-600">Overdue Books:</span>
                        <span class="font-semibold text-red-600 text-lg"></span>
                    </li>
                </ul>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Recent Activities</h3>
                <ul class="space-y-2">
                    
                        <li class="text-sm">
                            <span class="font-medium"></span>
                            <span></span>
                            <span class="text-gray-500"></span>
                        </li>
                    
                        <li>No recent activities.</li>
                    
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Quick Actions</h3>
                <div class="space-y-2">
                    <a href="" class="block w-full text-center py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Add New Book</a>
                    <a href="" class="block w-full text-center py-2 px-4 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300">Add New User</a>
                    <a href="" class="block w-full text-center py-2 px-4 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-300">Generate Report</a>
                </div>
            </div>
        </div>

        <!-- Recent Books Added -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Recently Added Books</h3>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left py-2">Title</th>
                        <th class="text-left py-2">Author</th>
                        <th class="text-left py-2">ISBN</th>
                        <th class="text-left py-2">Added Date</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <tr>
                            <td class="py-2"></td>
                            <td class="py-2"></td>
                            <td class="py-2"></td>
                            <td class="py-2"></td>
                        </tr>
                    
                        <tr>
                            <td colspan="4" class="py-2 text-center">No books added recently.</td>
                        </tr>
                    
                </tbody>
            </table>
        </div>
    </main>

    <footer class="mt-16 bg-gray-100 border-t border-gray-200">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center text-gray-600">
                <p>&copy;  Libement System. All rights reserved.</p>
                <p class="mt-2">Empowering knowledge seekers worldwide.</p>
            </div>
        </div>
    </footer>
</body>
</html>
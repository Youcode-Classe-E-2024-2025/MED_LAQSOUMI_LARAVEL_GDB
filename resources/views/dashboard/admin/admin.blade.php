<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
                <a href=""><i class="fas fa-book-open mr-2"></i><span class="text-indigo-600">Lib</span>Ement</a>
            </h1>
            <nav>
                <ul class="flex space-x-6">
                    @if($role === 'user')
                    <li><a href="{{route('dashboard')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-book mr-2"></i>Books</a></li>
                    <li><a href="{{route('myBooks')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-bookmark mr-2"></i>My Books</a></li>
                    <li><a href="{{route('profile')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                        </form>
                    </li>
                    @elseif($role === 'admin')
                    <li><a href="{{route('dashboard')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-chart-line mr-2"></i>Dashboard</a></li>
                    <li><a href="{{route('manageBooks')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-book mr-2"></i>Manage Books</a></li>
                    <li><a href="{{route('manageUsers')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-users mr-2"></i>Manage Users</a></li>
                    <li><a href="{{route('profile')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-4 flex-1">
        <h2 class="text-2xl font-semibold mb-6">Admin Dashboard</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
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
                        <span class="font-semibold text-green-600 text-lg">{{ count($users) }}</span>
                    </li>
                    <li class="flex justify-between items-center p-3 bg-gray-50 rounded-md hover:bg-gray-100 transition-colors">
                        <span class="text-gray-600">Total Borrowed Books:</span>
                        <span class="font-semibold text-red-600 text-lg">{{ count($borrows) }}</span>
                    </li>
                </ul>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Recent Activities</h3>
                <ul class="space-y-2">
                    @forelse ($books as $activity)
                        <li class="flex justify-between items-center py-2 border-b border-gray-200">
                            <span class="text-gray-600 ">{{ $activity->description }}</span>
                            <span class="text-sm text-gray-400 ">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $activity->created_at->diffForHumans() }}
                            </span>
                            <span class="text-sm text-gray-400 ">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ $activity->updated_at->format('Y-m-d') }}
                            </span>
                        </li>
                    @empty
                        <li class="text-gray-600">No recent activities.</li>
                    @endforelse
                </ul>
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
                    @forelse ($books as $book)
                        <tr>
                            <td class="py-2">{{ $book->title }}</td>
                            <td class="py-2">{{ $book->author }}</td>
                            <td class="py-2">{{ $book->isbn }}</td>
                            <td class="py-2">{{ $book->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-2 text-center">No books added recently.</td>
                        </tr>
                    @endforelse
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

    <script>
        document.getElementById('nav-toggle').onclick = function() {
            var navContent = document.getElementById('nav-content');
            if (navContent.classList.contains('hidden')) {
                navContent.classList.remove('hidden');
            } else {
                navContent.classList.add('hidden');
            }
        };
    </script>
</body>
</html>
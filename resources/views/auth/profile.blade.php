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
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-bookmark mr-2"></i>My Books</a></li>
                    <li><a href="{{route('profile')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
                        </form>
                    </li>
                    @elseif($role === 'admin')
                    <li><a href="{{route('dashboard')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-chart-line mr-2"></i>Dashboard</a></li>
                    <li><a href="{{route('manageBooks')}}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-books mr-2"></i>Manage Books</a></li>
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
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4"><i class="fas fa-user-circle mr-2"></i>Welcome, {{ $name }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600"><i class="fas fa-envelope mr-2"></i>Email: {{ $email }}</p>
                    <p class="text-gray-600"><i class="fas fa-calendar-alt mr-2"></i>Member since: {{ $created_at->format(' d/m/Y ') }}</p>
                </div>
            </div>
            @include('layouts.success-message')
            @include('layouts.error-message')
            <form method="POST" action="{{ route('editProfile') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700"><i class="fas fa-user mr-2"></i>{{ __('Name') }}</label>
                    <input id="name" type="text" class="w-full mt-1 p-2 border rounded-md @error('name') border-red-500 @enderror" name="name" value="{{ $name }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700"><i class="fas fa-envelope mr-2"></i>{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="w-full mt-1 p-2 border rounded-md @error('email') border-red-500 @enderror" name="email" value="{{ $email }}" required autocomplete="email">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-gray-700"><i class="fas fa-lock mr-2"></i>{{ __('Password') }}</label>
                    <input id="password" type="password" class="w-full mt-1 p-2 border rounded-md @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-save mr-2"></i>{{ __('Update Profile') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

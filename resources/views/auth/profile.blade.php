<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Libement System</title>
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
                <a href=""><span class="text-indigo-600">Lib</span>Ement</a>
            </h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="" class="text-gray-600 hover:text-blue-600 transition duration-300">My Books</a></li>
                    <li><a href="/profile" class="text-gray-600 hover:text-blue-600 transition duration-300">Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-blue-600 transition duration-300">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Profile') }}</h2>
            <form method="POST" action="">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">{{ __('Name') }}</label>
                    <input id="name" type="text" class="w-full mt-1 p-2 border border-gray-300 rounded-md @error('name') border-red-500 @enderror" name="name" value="{{ $name }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="text-red-500 text-sm mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="w-full mt-1 p-2 border border-gray-300 rounded-md @error('email') border-red-500 @enderror" name="email" value="{{ $email }}" required autocomplete="email">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300">
                        {{ __('Update Profile') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex flex-col h-screen">
    <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Library Management System</h1>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('register') }}" class="hover:underline">Register</a></li>
                    <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-8 p-4 flex-1">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-3xl font-bold mb-4">Welcome to Our Library</h2>
            <p class="text-gray-600 mb-4">
                Discover a world of knowledge at your fingertips. Our Library Management System 
                provides easy access to a vast collection of books and resources.
            </p>
            <div class="space-x-4">
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    Get Started
                </a>
                <a href="{{ route('login') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Member Login
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-200 text-center p-4 mt-8">
        <p>&copy; {{ date('Y') }} Library Management System. All rights reserved.</p>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100 flex flex-col min-h-screen" x-data="{ 
    showModal: false,
    editMode: false,
    userData: {
        id: '',
        name: '',
        email: '',
        role: '',
        password: ''
    }
}">
    <!-- Enhanced Header -->
    <header class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700 sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-bold">
                <a href="{{ route('dashboard') }}" class="bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text text-transparent hover:opacity-80 transition-all duration-300">
                    <i class="fas fa-book-open mr-2"></i>
                    <span class="font-extrabold">Lib</span>Ement
                </a>
            </h1>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="lg:hidden text-gray-300 hover:text-white focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:block">
                <ul class="flex items-center space-x-8">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-chart-line mr-2"></i>Dashboard</a></li>
                    <li><a href="{{ route('manageBooks') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Manage Books</a></li>
                    <li><a href="{{ route('manageUsers') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-users mr-2"></i>Manage Users</a></li>
                    <li><a href="{{ route('profile') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4 px-6">
            <nav class="flex flex-col space-y-4">
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-chart-line mr-2"></i>Dashboard</a>
                <a href="{{ route('manageBooks') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-book mr-2"></i>Manage Books</a>
                <a href="{{ route('manageUsers') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-users mr-2"></i>Manage Users</a>
                <a href="{{ route('profile') }}" class="text-gray-300 hover:text-blue-400 transition-colors duration-200"><i class="fas fa-user mr-2"></i>Profile</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-red-400 transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-6 py-8">
        <!-- Add New User Button -->
        <div class="mb-6">
            <button @click="showModal = true; editMode = false; userData = {
                id: '',
                name: '',
                email: '',
                role: 'user',
                password: ''
            }" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg 
                     hover:from-blue-600 hover:to-purple-700 focus:ring-2 focus:ring-blue-500 
                     focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300">
                <i class="fas fa-plus mr-2"></i>Add New User
            </button>
        </div>

        @include('layouts.success-message')
        @include('layouts.error-message')

        <!-- Enhanced Users Table -->
        <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl border border-gray-700 shadow-xl overflow-hidden animate-fade-in">
            <div class="px-8 py-6 border-b border-gray-700">
                <h4 class="text-xl font-semibold text-gray-100">Manage Users</h4>
                <p class="text-gray-400 mt-1">Total Users: {{ count($users) }}</p>
            </div>
            
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-300">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-400">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $user->role === 'admin' ? 'bg-green-900/50 text-green-400' : 'bg-blue-900/50 text-blue-400' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <button @click="
                                        editMode = true;
                                        showModal = true;
                                        userData = {
                                            id: '{{ $user->id }}',
                                            name: '{{ $user->name }}',
                                            email: '{{ $user->email }}',
                                            role: '{{ $user->role }}',
                                            password: ''
                                        }
                                    " class="text-blue-400 hover:text-blue-300 transition-colors mr-4">
                                        <i class="fas fa-edit mr-1"></i>
                                    </button>
                                    <a href="{{ route('delete-user', ['id' => $user->id]) }}" 
                                       onclick="return confirm('Are you sure you want to delete this user?')"
                                       class="text-red-400 hover:text-red-300 transition-colors">
                                        <i class="fas fa-trash-alt mr-1"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal for Add/Edit User -->
        <div x-show="showModal" 
             class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="bg-gray-800 rounded-xl shadow-2xl w-full max-w-3xl overflow-hidden border border-gray-700"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="transform scale-95"
                 x-transition:enter-end="transform scale-100">
                <div class="border-b border-gray-700 px-8 py-4 flex justify-between items-center">
                    <h4 class="text-xl font-semibold text-gray-100" x-text="editMode ? 'Edit User' : 'Add New User'"></h4>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-200 transition duration-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <!-- Form content with dark theme classes -->
                <div class="p-8">
                    <form x-bind:action="editMode ? '/users/update/' + userData.id : '{{ route('create-user') }}'" method="POST">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>
                        <!-- Form fields with dark theme styling -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                                <input type="text" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                       id="name" name="name" x-model="userData.name" required>
                            </div>
                            <!-- Email field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                       id="email" name="email" x-model="userData.email" required>
                            </div>
                            <!-- Role field -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                                <select class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 
                                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                        id="role" name="role" x-model="userData.role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <!-- Password field -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                                    <span x-text="editMode ? 'Password (leave blank to keep current)' : 'Password'"></span>
                                </label>
                                <input type="password" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 
                                       focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                       id="password" name="password" x-model="userData.password" :required="!editMode">
                            </div>
                            <!-- Form buttons -->
                            <div class="md:col-span-2 flex justify-end space-x-4">
                                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg 
                                         hover:from-blue-600 hover:to-purple-700 focus:ring-2 focus:ring-blue-500 
                                         focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-300" 
                                        x-text="editMode ? 'Update User' : 'Create User'"></button>
                                <button type="button" @click="showModal = false" 
                                        class="px-6 py-2.5 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 
                                               focus:ring-2 focus:ring-gray-500 transition-all duration-300">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('animate-fade-in');
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
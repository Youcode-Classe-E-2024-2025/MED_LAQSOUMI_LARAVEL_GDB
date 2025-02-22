<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Libement System</title>
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
    userData: {
        id: '',
        name: '',
        email: '',
        role: '',
        password: ''
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
                    <li><a href="{{ route('manageUsers') }}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-users mr-2"></i>Manage Users</a></li>
                    <li><a href="{{ route('profile') }}" class="text-gray-600 hover:text-blue-600 transition duration-300"><i class="fas fa-user mr-2"></i>Profile</a></li>
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
        <!-- Add New User Button -->
        <div class="mb-4">
            <button @click="showModal = true; editMode = false; userData = {
                id: '',
                name: '',
                email: '',
                role: 'user',
                password: ''
            }" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all">Add New User</button>
        </div>
        @include('layouts.success-message')
        @include('layouts.error-message')
        <!-- Enhanced Add/Edit User Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-sm w-full max-w-3xl overflow-hidden">
                <div class="border-b px-8 py-4 flex justify-between items-center">
                    <h4 class="text-xl font-semibold text-gray-800" x-text="editMode ? 'Edit User' : 'Add New User'"></h4>
                    <button @click="showModal = false" class="text-gray-600 hover:text-gray-800 transition duration-300">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-8">
                    <form x-bind:action="editMode ? '/users/update/' + userData.id : '{{ route('create-user') }}'" method="POST" class="max-w-3xl">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="name" name="name" x-model="userData.name" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="email" name="email" x-model="userData.email" required>
                            </div>
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="role" name="role" x-model="userData.role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    <span x-text="editMode ? 'Password (leave blank to keep current)' : 'Password'"></span>
                                </label>
                                <input type="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" 
                                    id="password" name="password" x-model="userData.password" :required="!editMode">
                            </div>
                            <div class="md:col-span-2 flex justify-end space-x-4">
                                <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 transition-all" 
                                    x-text="editMode ? 'Update User' : 'Create User'"></button>
                                <button type="button" @click="showModal = false" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 focus:ring-4 focus:ring-gray-100 transition-all">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Enhanced Users Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
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
                            " class="text-blue-600 hover:text-blue-800 mr-2">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <a href="{{ route('delete-user', ['id' => $user->id]) }}" 
                               onclick="return confirm('Are you sure you want to delete this user?')"
                               class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
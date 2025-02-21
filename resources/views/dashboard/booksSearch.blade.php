<!-- Book Search -->
<div class="mt-8 bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-4">Search for Books</h3>
    {{-- <form action="{{ route('books.search') }}" method="GET" class="flex gap-4"> --}}
        <input type="text" 
               name="query" 
               {{-- value="{{ request('query') }}" --}}
               placeholder="Enter book title, author, or ISBN" 
               class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Search</button>
    {{-- </form> --}}
</div>
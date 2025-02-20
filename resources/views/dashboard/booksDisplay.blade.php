        <!-- Search Results -->
        @if (isset($books) && $books->count() > 0)
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($books as $book)
            <div class="bg-white p-4 rounded-lg shadow-md">
            <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="w-full h-64 object-cover rounded-md">
            <h4 class="font-semibold">{{ $book->title }}</h4>
            <p class="text-gray-600">By {{ $book->author }}</p>
            <p class="text-gray-500">ISBN: {{ $book->isbn }}</p>
            <div class="mt-4 flex gap-4 items-center">
                {{-- <p class="text-gray-600">Published on {{ $book->published_at->format('M d, Y') }}</p> --}}
                <a href="" 
                   class="inline-block px-4 py-2 text-blue-600 rounded-md">
                   <i class="fas fa-eye"></i>
                </a>
                <a href="" 
                   class="inline-block px-4 py-2 text-yellow-600 transition duration-300">
                <i class="fas fa-edit"></i>
                </a>
                <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                    class="inline-block px-4 py-2 text-red-600 transition duration-300">
                    <i class="fas fa-trash"></i>
                </button>
                </form>
            </div>
            </div>
            @endforeach
        </div>
        {{-- {{ $books->links() }} --}}
        @elseif(request('query'))
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <p class="text-gray-600">No books found matching your search criteria.</p>
        </div>
        @endif
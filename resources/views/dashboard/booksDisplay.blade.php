        <!-- Search Results -->
        @if ($books->count())
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($books as $book)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h4 class="font-semibold">{{ $book->title }}</h4>
                <p class="text-gray-600">By {{ $book->author }}</p>
                <p class="text-gray-500">ISBN: {{ $book->isbn }}</p>
                <div class="mt-4">
                    <a href="{{ route('books.show', $book->id) }}" 
                       class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        {{ $books->links() }}
        @elseif(request('query'))
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <p class="text-gray-600">No books found matching your search criteria.</p>
        </div>
        @endif
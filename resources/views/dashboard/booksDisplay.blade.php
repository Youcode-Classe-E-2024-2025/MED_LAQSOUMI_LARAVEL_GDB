        <!-- Search Results -->
        @if (isset($books) && $books->count() > 0)
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($books as $book)
                        <a href="{{ route('view-book', $book->id) }}" class="block">
                            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                <div class="relative overflow-hidden rounded-lg mb-4">
                                    <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="w-full h-72 object-cover transform hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="space-y-2">
                                    <h4 class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors">{{ $book->title }}</h4>
                                    <p class="text-gray-600 font-medium">By {{ $book->author }}</p>
                                    <div class="pt-2 space-y-1">
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <span class="font-medium mr-2">ISBN:</span> {{ $book->isbn }}
                                        </p>
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <span class="font-medium mr-2">Published:</span> {{ $book->created_at->format('m-d-Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
        @elseif(request('query'))
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <p class="text-gray-600">No books found matching your search criteria.</p>
        </div>
        @endif
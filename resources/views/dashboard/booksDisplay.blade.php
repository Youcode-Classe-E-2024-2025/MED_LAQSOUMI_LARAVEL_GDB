<div class="mt-8 bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-4">Search for Books</h3>
    <input type="text" id="query" name="query" placeholder="Enter book title, author, or ISBN" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    
    <!-- Add a container for search results -->
    <div id="searchResults" class="mt-4"></div>
</div>

<!-- Search Results -->
<div id="booksContainer" class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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

@if (isset($books) && $books->count() === 0)
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <p class="text-gray-600">No books found matching your search criteria.</p>
    </div>
@endif

<script>
   document.querySelector('#query').addEventListener('input', function(e) {
       let query = e.target.value;
       let searchResults = document.querySelector('#searchResults');
       let booksContainer = document.querySelector('#booksContainer');
       searchResults.innerHTML = '';
       booksContainer.innerHTML = '';

       if (query.length <= 0) {
           fetch('/manageBooks')
               .then(response => response.json())
               .then(data => {
                   data.forEach(book => {
                       let bookElement = document.createElement('div');
                       bookElement.innerHTML = `
                           <a href="/books/view/${book.id}" class="block">
                               <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                   <div class="relative overflow-hidden rounded-lg mb-4">
                                       <img src="${book.cover}" alt="${book.title}" class="w-full h-72 object-cover transform hover:scale-105 transition-transform duration-300">
                                   </div>
                                   <div class="space-y-2">
                                       <h4 class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors">${book.title}</h4>
                                       <p class="text-gray-600 font-medium">By ${book.author}</p>
                                       <div class="pt-2 space-y-1">
                                           <p class="text-sm text-gray-500 flex items-center">
                                               <span class="font-medium mr-2">ISBN:</span> ${book.isbn}
                                           </p>
                                           <p class="text-sm text-gray-500 flex items-center">
                                               <span class="font-medium mr-2">Published:</span> ${new Date(book.created_at).toLocaleDateString()}
                                           </p>
                                       </div>
                                   </div>
                               </div>
                           </a>
                       `;
                       booksContainer.appendChild(bookElement);
                   });
               });
           return;
       }

       fetch(`/book/search/${query}`)
           .then(response => response.json())
           .then(data => {
               data.forEach(book => {
                   let bookElement = document.createElement('div');
                   bookElement.innerHTML = `
                       <a href="/books/view/${book.id}" class="block">
                           <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                               <div class="relative overflow-hidden rounded-lg mb-4">
                                   <img src="${book.cover}" alt="${book.title}" class="w-full h-72 object-cover transform hover:scale-105 transition-transform duration-300">
                               </div>
                               <div class="space-y-2">
                                   <h4 class="text-xl font-bold text-gray-800 hover:text-blue-600 transition-colors">${book.title}</h4>
                                   <p class="text-gray-600 font-medium">By ${book.author}</p>
                                   <div class="pt-2 space-y-1">
                                       <p class="text-sm text-gray-500 flex items-center">
                                           <span class="font-medium mr-2">ISBN:</span> ${book.isbn}
                                       </p>
                                       <p class="text-sm text-gray-500 flex items-center">
                                           <span class="font-medium mr-2">Published:</span> ${new Date(book.created_at).toLocaleDateString()}
                                       </p>
                                   </div>
                               </div>
                           </div>
                       </a>
                   `;
                   booksContainer.appendChild(bookElement);
               });
           });
   });
</script>
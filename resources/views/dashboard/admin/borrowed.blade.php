@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Borrowed Books</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Borrower</th>
                <th>Date Borrowed</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowedBooks as $borrowed)
            <tr>
                <td>{{ $borrowed->book->title }}</td>
                <td>{{ $borrowed->user->name }}</td>
                <td>{{ $borrowed->borrowed_at }}</td>
                <td>{{ $borrowed->due_date }}</td>
                <td>{{ $borrowed->returned_at ? 'Returned' : 'Borrowed' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

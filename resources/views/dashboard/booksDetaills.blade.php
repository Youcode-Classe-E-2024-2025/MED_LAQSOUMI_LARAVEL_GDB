<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Libement System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2>{{ $book->title }}</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid" alt="Book Cover">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th>Author:</th>
                            <td>{{ $book->author }}</td>
                        </tr>
                        <tr>
                            <th>ISBN:</th>
                            <td>{{ $book->isbn }}</td>
                        </tr>
                        <tr>
                            <th>Category:</th>
                            <td>{{ $book->category }}</td>
                        </tr>
                        <tr>
                            <th>Published Date:</th>
                            <td>{{ $book->created }}</td>
                        </tr>
                        {{-- <tr>
                            <th>Available Copies:</th>
                            <td>{{ $book->available_copies }}</td>
                        </tr> --}}
                    </table>

                    <div class="description mt-3">
                        <h4>Description</h4>
                        <p>{{ $book->description }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="" class="btn btn-primary">Edit</a>
                        <a href="" class="btn btn-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
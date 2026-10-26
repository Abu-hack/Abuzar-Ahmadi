
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IT Student Portal</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>IT Student Portal</h1>
            <p class="mb-0">
                Welcome, {{ auth()->user()->name }}.
            </p>
            <p class="mb-0">
                Email: {{ auth()->user()->email }}
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">
                Logout
            </button>
        </form>
    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Book registration form --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h4 class="mb-0">Register a Book</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('books.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">
                        Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        maxlength="150"
                        value="{{ old('title') }}"
                        class="form-control @error('title') is-invalid @enderror"
                        required
                    >

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label">
                        Author
                    </label>

                    <input
                        type="text"
                        name="author"
                        id="author"
                        maxlength="100"
                        value="{{ old('author') }}"
                        class="form-control @error('author') is-invalid @enderror"
                        required
                    >

                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pages" class="form-label">
                        Pages
                    </label>

                    <input
                        type="number"
                        name="pages"
                        id="pages"
                        min="1"
                        max="10000"
                        value="{{ old('pages') }}"
                        class="form-control @error('pages') is-invalid @enderror"
                        required
                    >

                    @error('pages')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    Add Book
                </button>
            </form>
        </div>
    </div>

    {{-- Registered books table --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">My Books</h4>
        </div>

        <div class="card-body">

            @if ($books->isEmpty())
                <p class="text-muted mb-0">
                    You have not registered any books yet.
                </p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Pages</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->pages }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>

</div>

</body>
</html>

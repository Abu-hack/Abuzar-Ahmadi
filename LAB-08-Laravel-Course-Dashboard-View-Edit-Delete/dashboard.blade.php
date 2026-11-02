
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set the text format and page size. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Course Dashboard</title>

    <!-- Load the dashboard CSS file. -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

    <!-- Top navigation bar. -->
    <header class="topbar">
        <div class="container nav-row">

            <a class="brand" href="{{ route('dashboard') }}">
                Course Dashboard
            </a>

            <!-- Logout form. -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-light" type="submit">
                    Logout
                </button>
            </form>

        </div>
    </header>

    <!-- Main dashboard content. -->
    <main class="container page">

        <!-- Show the logged-in student's name. -->
        <h1>Welcome, {{ auth()->user()->name }}!</h1>

        <p class="muted">
            Register and manage your own courses.
        </p>

        <!-- Display a message after a successful action. -->
        @if (session('success'))
            <div class="notice success" role="status">
                {{ session('success') }}
            </div>
        @endif

        <!-- Course form and course list. -->
        <div class="dashboard-grid">

            <section class="card">
                @include('courses.form')
            </section>

            <section class="card">
                @include('courses.table')
            </section>

        </div>

        <!-- Display details of the selected course. -->
        @if ($viewing)
            @include('courses.details')
        @endif

    </main>
</body>
</html>

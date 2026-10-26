<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display the logged-in user's books
    public function index()
    {
        $books = auth()->user()
            ->books()
            ->latest()
            ->get();

        return view('dashboard', compact('books'));
    }

    // Register a new book
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'author' => 'required|string|max:100',
            'pages' => 'required|integer|min:1|max:10000',
        ]);

        // Assign the book to the logged-in user
        $validated['user_id'] = $request->user()->id;

        // Save the book in the database
        Book::create($validated);

        // Return to the dashboard with a success message
        return redirect()
            ->route('dashboard')
            ->with('success', 'Book added successfully!');
    }
}

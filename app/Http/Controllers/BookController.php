<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('books')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->select(
                'books.*',
                'categories.name as category_name',
                'authors.name as author_name'
            )
            ->orderByDesc('books.id')
            ->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = DB::table('categories')->orderBy('name')->get();
        $authors = DB::table('authors')->orderBy('name')->get();

        return view('books.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255', 'unique:books,isbn'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'description' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            // stored under storage/app/public/covers
            $coverPath = $request->file('cover_image')->store('covers', 'public'); // "covers/abc.jpg"
        }

        DB::table('books')->insert([
            'title' => $validated['title'],
            'isbn' => $validated['isbn'],
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'cover_image' => $coverPath,
            'description' => $validated['description'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        abort_if(!$book, 404);

        $categories = DB::table('categories')->orderBy('name')->get();
        $authors = DB::table('authors')->orderBy('name')->get();

        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        abort_if(!$book, 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => [
                'required', 'string', 'max:255',
                Rule::unique('books', 'isbn')->ignore($id),
            ],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'author_id' => ['required', 'integer', 'exists:authors,id'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'description' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
        ]);

        $coverPath = $book->cover_image;

        if ($request->hasFile('cover_image')) {
            // delete old file if exists
            if ($coverPath && Storage::disk('public')->exists($coverPath)) {
                Storage::disk('public')->delete($coverPath);
            }
            $coverPath = $request->file('cover_image')->store('covers', 'public');
        }

        DB::table('books')->where('id', $id)->update([
            'title' => $validated['title'],
            'isbn' => $validated['isbn'],
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'cover_image' => $coverPath,
            'description' => $validated['description'] ?? null,
            'published_at' => $validated['published_at'] ?? null,
            'updated_at' => now(),
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        abort_if(!$book, 404);

        if ($book->cover_image && Storage::disk('public')->exists($book->cover_image)) {
            Storage::disk('public')->delete($book->cover_image);
        }

        DB::table('books')->where('id', $id)->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    // Optional: show() if you want (not required by your spec)
    public function show($id)
    {
        $book = DB::table('books')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->select('books.*', 'categories.name as category_name', 'authors.name as author_name')
            ->where('books.id', $id)
            ->first();

        abort_if(!$book, 404);

        return view('books.show', compact('book'));
    }
}
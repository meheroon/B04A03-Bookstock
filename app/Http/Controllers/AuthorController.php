<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = DB::table('authors')->orderByDesc('id')->get();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
        ]);

        DB::table('authors')->insert([
            'name' => $validated['name'],
            'bio' => $validated['bio'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function edit($id)
    {
        $author = DB::table('authors')->where('id', $id)->first();
        abort_if(!$author, 404);
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $author = DB::table('authors')->where('id', $id)->first();
        abort_if(!$author, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
        ]);

        DB::table('authors')->where('id', $id)->update([
            'name' => $validated['name'],
            'bio' => $validated['bio'] ?? null,
            'updated_at' => now(),
        ]);

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('authors')->where('id', $id)->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}

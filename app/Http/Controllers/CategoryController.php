<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->orderByDesc('id')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        DB::table('categories')->insert([
            'name' => $validated['name'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        abort_if(!$category, 404);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        abort_if(!$category, 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        DB::table('categories')->where('id', $id)->update([
            'name' => $validated['name'],
            'updated_at' => now(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

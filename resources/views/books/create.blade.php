@extends('layout')

@section('title','Create Book')
@section('page_title','Create Book')
@section('page_subtitle','Add a new book to your library')

@section('top_action')
  <a href="{{ route('books.index') }}" class="px-4 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">Back</a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
  <div class="p-6">
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
        <input name="title" value="{{ old('title') }}" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" />
        @error('title') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">ISBN *</label>
        <input name="isbn" value="{{ old('isbn') }}" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" />
        @error('isbn') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
          <select name="category_id" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Select category</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
          @error('category_id') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Author *</label>
          <select name="author_id" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Select author</option>
            @foreach($authors as $author)
              <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
            @endforeach
          </select>
          @error('author_id') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Cover Image (jpeg/png/jpg, max 2MB)</label>
        <input type="file" name="cover_image" class="w-full rounded-lg border-gray-200" />
        @error('cover_image') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Published Date</label>
        <input type="date" name="published_at" value="{{ old('published_at') }}" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" />
        @error('published_at') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
        @error('description') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
      </div>

      <div class="flex items-center gap-3">
        <button class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-md">Save</button>
        <a href="{{ route('books.index') }}" class="px-5 py-2.5 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection

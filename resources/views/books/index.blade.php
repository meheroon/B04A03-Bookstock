@extends('layout')

@section('title','Books')
@section('page_title','Books')
@section('page_subtitle','Manage your book collection')

@section('top_action')
  <a href="{{ route('books.create') }}" class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
    </svg>
    <span class="font-medium">Add Book</span>
  </a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Cover</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ISBN</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Author</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Published</th>
          <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        @forelse($books as $book)
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4">
              @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="cover" class="w-12 h-12 rounded-lg object-cover border" />
              @else
                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-xs text-gray-500">N/A</div>
              @endif
            </td>
            <td class="px-6 py-4 font-semibold text-gray-800">{{ $book->title }}</td>
            <td class="px-6 py-4 text-gray-700">{{ $book->isbn }}</td>
            <td class="px-6 py-4 text-gray-700">{{ $book->category_name ?? '—' }}</td>
            <td class="px-6 py-4 text-gray-700">{{ $book->author_name ?? '—' }}</td>
            <td class="px-6 py-4 text-gray-700">{{ $book->published_at ?? '—' }}</td>
            <td class="px-6 py-4 text-right">
              <a href="{{ route('books.edit', $book->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50">Edit</a>
              <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete this book?')" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-red-200 text-sm font-medium text-red-600 hover:bg-red-50 ml-2">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="px-6 py-10 text-center text-gray-500">No books found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@extends('layout')

@section('title','Categories')
@section('page_title','Categories')
@section('page_subtitle','Manage categories')

@section('top_action')
  <a href="{{ route('categories.create') }}" class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-md">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
    </svg>
    <span class="font-medium">Add Category</span>
  </a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">#</th>
          <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
          <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100">
        @forelse($categories as $cat)
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 text-gray-700">{{ $cat->id }}</td>
            <td class="px-6 py-4 font-semibold text-gray-800">{{ $cat->name }}</td>
            <td class="px-6 py-4 text-right">
              <a href="{{ route('categories.edit', $cat->id) }}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 text-sm font-medium text-gray-700 hover:bg-gray-50">Edit</a>
              <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Delete this category?')" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-red-200 text-sm font-medium text-red-600 hover:bg-red-50 ml-2">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="3" class="px-6 py-10 text-center text-gray-500">No categories found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

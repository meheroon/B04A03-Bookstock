@extends('layout')

@section('title','Create Category')
@section('page_title','Create Category')
@section('page_subtitle','Add a new category')

@section('top_action')
  <a href="{{ route('categories.index') }}" class="px-4 py-2 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">Back</a>
@endsection

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
  <div class="p-6">
    <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
        <input name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500" />
        @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
      </div>
      <div class="flex items-center gap-3">
        <button class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 shadow-md">Save</button>
        <a href="{{ route('categories.index') }}" class="px-5 py-2.5 rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50">Cancel</a>
      </div>
    </form>
  </div>
</div>
@endsection

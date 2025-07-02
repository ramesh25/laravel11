@extends('layouts.admin.master')

@section('content')
@include('admin.partials.breadcrumb')

<div class="flex justify-between items-center mb-4">
  <!-- Left side: Back + Create -->
  <!-- <div class="space-x-2"> -->
    <!-- Back Button -->
    <a href="{{ url('admin/nav') }}" class="inline-flex items-center px-4 py-2 bg-cyan-600 text-white text-sm font-medium rounded hover:bg-cyan-700 transition">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
      Back
    </a>
  <!-- </div> -->
</div>

@if ($message = Session::get('success'))
<div class="col-xl-12 grid-margin stretch-card flex-column">
  <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{!! $message !!}</span>
    <button 
      type="button" 
      class="absolute top-0 bottom-0 right-0 px-4 py-3" 
      aria-label="Close"
      onclick="document.getElementById('success-alert').style.display='none';"
    >
      <svg class="fill-current h-6 w-6 text-green-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <title>Close</title>
        <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238A1 1 0 105.652 5.652L8.586 8.586 5.652 11.52a1 1 0 101.414 1.414L10 9.828l2.934 2.934a1 1 0 001.414-1.414L11.414 8.586l2.934-2.934z"/>
      </svg>
    </button>
  </div>
</div>
@endif

<div class="min-h-screen flex items-center justify-center bg-gray-100">
  <form action="{{ route('nav.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-6xl">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6"> 
      <!-- Left Column (8 cols) -->
      <div class="md:col-span-8">
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Nav Information</h2>
          <!-- Parent -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Parent</label>
          <select name="parent_id" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
            @foreach($options as $value => $label)
              <option value="{{ $value }}" {{ $parent_id == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
          </select>
          @error('parent_id') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
         <!-- Type -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
        <select name="type" id="type" onchange="changeType(this.value)" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
          <option value="">--- Select ---</option>
          <option value="none">None</option>
          <option value="pages">Pages</option>
          <option value="categories">Categories</option>
          <option value="blogs">Blogs</option>
          <option value="routes">Routes</option>
          <option value="link">Link</option>
        </select>
        @error('type') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
      </div>
      <!-- Type Partial -->
      <div class="mb-4" id="group">
        @include('admin.nav.nav_type_partial_a')
      </div>

          <!-- Title -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400" >
            @error('title') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>
          <!-- URL -->
      <div class="mb-4" id="url_section">
        <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
        <input type="text" name="url" id="url" class="w-full border rounded px-4 py-2" placeholder="URL" value="{{ old('url') }}">
        @error('url') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
      </div>

          <!-- Publish Dropdown -->
          <div class="mb-4 flex items-center">
            <label class="text-sm font-medium text-gray-700 mr-4 w-24">Status</label>
            <select name="publish" class="flex-1 border rounded px-4 py-2 focus:ring focus:border-blue-400">
              <option value="1" {{ old('publish', '1') == '1' ? 'selected' : '' }}>Publish</option>
              <option value="0" {{ old('publish') == '0' ? 'selected' : '' }}>Unpublish</option>
            </select>
            @error('publish') <p class="text-sm text-red-500 mt-1 w-full">{{ $message }}</p> @enderror
          </div>

          <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Save nav</button>
          </div>
        </div>
        
      </div>
    </div> 
  </form>
</div>
@endsection
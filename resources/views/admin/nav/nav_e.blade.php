@extends('layouts.admin.master')
@section('content')
@include('admin.partials.breadcrumb')
<div class="flex justify-between items-center mb-4">
  <!-- Left side: Back + Create -->
  <div class="space-x-2">
    <!-- Back Button -->
    <a href="{{ url('admin/adve') }}" class="inline-flex items-center px-4 py-2 bg-cyan-600 text-white text-sm font-medium rounded hover:bg-cyan-700 transition">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
      Back
    </a>
  </div>
</div>

<div class="col-xl-12 grid-margin stretch-card flex-column">
  @if ($message = Session::get('success'))
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
  @endif
</div>

<form action="{{ route('advertise.update', $model->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

    <!-- Left Column (8 cols) -->
    <div class="md:col-span-8">
      <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h2>
        <!-- Title -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
          <input type="text" name="title" value="{{ old('title', $model->title) }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400" required>
          @error('title') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Image -->
        <div class="mb-4 md:flex md:items-start">
          <label for="image" class="md:w-1/4 font-medium text-gray-700">Image<span class="text-red-500">*</span></label>
          <div class="md:w-1/2">
            <input type="file" name="image" id="image" onchange="readURL(this);" 
              class="w-full text-sm text-gray-700 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
            >
            @error('image')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Preview and Delete Checkbox --}}
          <div class="md:w-1/4 mt-4 md:mt-0">
            @if (isset($model) && $model->image)
              <a href="{{ asset($model->upload . $model->image) }}" data-lumos="gallery1">
                <img id="previewimg" src="{{ asset($model->upload . $model->image) }}" class="w-36 h-20 object-cover rounded border" />
              </a>
              <div class="mt-2 flex items-center space-x-2">
                <input type="checkbox" name="delete_image" id="delete_image" value="1" class="text-blue-600 rounded">
                <label for="delete_image" class="text-sm text-gray-700">Remove Image</label>
              </div>
            @else
              <img id="previewimg" src="" class="w-36 h-20 object-cover rounded border" />
            @endif
          </div>
        </div>

       <!-- Title -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Link<span class="text-red-500">*</span></label>
          <input type="text" name="link" value="{{ old('link', $model->link) }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400" required>
          @error('link') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>
         <!-- Publish Dropdown -->
        <div class="mb-4 flex items-center">
          <label class="text-sm font-medium text-gray-700 mr-4 w-24">Status</label>
          <select name="publish" class="flex-1 border rounded px-4 py-2 focus:ring focus:border-blue-400">
            <option value="1" {{ old('publish', $model->publish) == '1' ? 'selected' : '' }}>Publish</option>
            <option value="0" {{ old('publish', $model->publish) == '0' ? 'selected' : '' }}>Unpublish</option>
          </select>
          @error('publish') <p class="text-sm text-red-500 mt-1 w-full">{{ $message }}</p> @enderror
        </div>
         <div class="mt-6">
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update advertises</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection


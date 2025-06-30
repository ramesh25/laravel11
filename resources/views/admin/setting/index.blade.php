@extends('layouts.admin.master')
@section('content')
@include('admin.partials.breadcrumb')
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

@if(isset($model))
<form action="{{ route('setting.update', $model->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')  {{-- Important --}}
@else
<form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
@csrf
@endif
  
  <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

    <!-- Left Column (8 cols) -->
    <div class="md:col-span-8">
      <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Basic Information</h2>

        <!--Site Title -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Site Title <span class="text-red-500">*</span></label>
          <input type="text" name="site_title" value="{{ old('site_title', $model->site_title ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
          @error('site_title') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
          <!-- Email -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="{{ old('email', $model->email ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
            @error('email') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <!-- Email 2 -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email 2 <span class="text-red-500">*</span></label>
            <input type="email" name="email_2" value="{{ old('email_2', $model->email_2 ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
            @error('email_2') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
            <input type="number" name="mobile_no" value="{{ old('mobile_no', $model->mobile_no ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
            @error('mobile_no') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone 2<span class="text-red-500">*</span></label>
            <input type="number" name="mobile_no_2" value="{{ old('mobile_no_2', $model->mobile_no_2 ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
            @error('mobile_no_2') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Landline <span class="text-red-500">*</span></label>
            <input type="number" name=" landline" value="{{ old('landline', $model->landline ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400" placeholder="Landline number">
            @error('landline') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <!-- Link -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Landline 2 <span class="text-red-500">*</span></label>
            <input type="text" name="landline_2" value="{{ old('landline', $model->landline ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400" placeholder="Landline number 2">
            @error('landline') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fax <span class="text-red-500">*</span></label>
            <input type="number" name=" fax" value="{{ old('fax', $model->fax ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400" placeholder="Fax number">
            @error('fax') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <!-- Post Code -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Post Code <span class="text-red-500">*</span></label>
            <input type="text" name="post_code" value="{{ old('post_code', $model->post_code ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400" placeholder="Post Code">
            @error('post_code') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>
        <!-- Address -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Address <span class="text-red-500">*</span></label>
          <input type="text" name="address" value="{{ old('address', $model->address ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400" placeholder="Address">
          @error('address') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Google Analytics -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Google Analytics</label>
          <textarea name="google_analytics" rows="3" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">{{ old('google_analytics', $model->google_analytics ?? '') }}</textarea>
          @error('google_analytics') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Meta Title -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
          <input type="text" name="meta_title" value="{{ old('meta_title', $model->meta_title ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
          @error('meta_title') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Meta Keywords -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
          <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $model->meta_keywords ?? '') }}" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">
          @error('meta_keywords') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Meta Description -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
          <textarea name="meta_description" rows="3" class="w-full border rounded px-4 py-2 focus:ring focus:border-blue-400">{{ old('meta_description', $model->meta_description ?? '') }}</textarea>
          @error('meta_description') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

      </div>
    </div>

    <!-- Right Column (4 cols) -->
    <div class="md:col-span-4">
      <div class="bg-white p-6 rounded shadow">

        <!-- Logo Image -->
        <div class="mb-4 md:flex md:items-start">
          <label for="image" class="md:w-1/4 font-medium text-gray-700">Logo<span class="text-red-500">*</span></label>
          <div class="md:w-1/2">
            <input type="file" name="logo" id="image" onchange="readURL(this);" 
              class="w-full text-sm text-gray-700 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
            >
            @error('logo')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Preview and Delete Checkbox --}}
          <div class="md:w-1/4 mt-4 md:mt-0">
            @if (isset($model) && $model->logo)
              <a href="{{ asset($model->upload . $model->logo) }}" data-lumos="gallery1">
                <img id="previewimg" src="{{ asset($model->upload . $model->logo) }}" class="w-36 h-20 object-cover rounded border" />
              </a>
              <div class="mt-2 flex items-center space-x-2">
                <input type="checkbox" name="delete_logo" id="delete_logo" value="1" class="text-blue-600 rounded">
                <label for="delete_logo" class="text-sm text-gray-700">Remove Logo</label>
              </div>
            @else
              <img id="previewimg" src="" class="w-36 h-20 object-cover rounded border" />
            @endif
          </div>
        </div>

        <!-- Favicon Image -->
        <div class="mb-4 md:flex md:items-start">
          <label for="favicon" class="md:w-1/4 font-medium text-gray-700">Favicon<span class="text-red-500">*</span></label>
          <div class="md:w-1/2">
            <input type="file" name="favicon" id="favicon" onchange="readURL1(this);" 
              class="w-full text-sm text-gray-700 border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
            >
            @error('favicon')
              <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
          </div>

          {{-- Preview and Delete Checkbox --}}
          <div class="md:w-1/4 mt-4 md:mt-0">
            @if (isset($model) && $model->favicon)
              <a href="{{ asset($model->upload . $model->favicon) }}" data-lumos="gallery1">
                <img id="previewimg1" src="{{ asset($model->upload . $model->favicon) }}" class="w-36 h-20 object-cover rounded border" />
              </a>
              <div class="mt-2 flex items-center space-x-2">
                <input type="checkbox" name="delete_favicon" id="delete_favicon" value="1" class="text-blue-600 rounded">
                <label for="delete_favicon" class="text-sm text-gray-700">Remove Favicon</label>
              </div>
            @else
              <img id="previewimg1" src="" class="w-36 h-20 object-cover rounded border" />
            @endif
          </div>
        </div>

        <div class="mt-6">
          <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Setting</button>
        </div>

      </div>
    </div>

  </div>
</form>
@endsection
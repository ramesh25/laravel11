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

<div class="max-h-screen flex items-center justify-center bg-gray-100">
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
                <select name="parent_id" class="w-full border rounded px-4 py-2">
                    @foreach($options as $key => $value)
                        <option value="{{ $key }}" {{ old('parent_id', $parent_id) == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
                @error('parent_id') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
            </div>
            <!-- Type -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select name="type" id="type" class="w-full border rounded px-4 py-2" onchange="changeType(this.value)">
                    <option value="">-- Select --</option>
                    <option value="none" {{ old('type') == 'none' ? 'selected' : '' }}>None</option>
                    <option value="pages" {{ old('type') == 'pages' ? 'selected' : '' }}>Pages</option>
                    <option value="categories" {{ old('type') == 'categories' ? 'selected' : '' }}>Categories</option>
                    <option value="routes" {{ old('type') == 'routes' ? 'selected' : '' }}>Routes</option>
                    <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>Link</option>
                </select>
                @error('type') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
            </div>
            <!-- Type Partial -->
            <div class="mb-4" id="group">
              @include('admin.nav.nav_type_partial_a')
            </div>
            <!-- Title -->
            <div id="title_section" class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border rounded px-4 py-2" />
                @error('title') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
            </div>
            <!-- URL -->
            <div id="url_section" class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                <input type="text" name="url" id="url" value="{{ old('url') }}" class="w-full border rounded px-4 py-2" />
                @error('url') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
            </div>
            <!-- Target -->
            <div class="mb-4">
                <span class="block text-sm font-medium text-gray-700 mb-1">New Page</span>
                <label class="inline-flex items-center mr-4">
                    <input type="radio" name="target" value="1" class="form-radio" {{ old('target') == '1' ? 'checked' : '' }}> <span class="ml-2">Yes</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="target" value="0" class="form-radio" {{ old('target', '0') == '0' ? 'checked' : '' }}> <span class="ml-2">No</span>
                </label>
            </div>
            <!-- Right Section -->
            <!-- <div class="bg-white p-6 rounded shadow"> -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="publish" class="w-full border rounded px-4 py-2">
                    <option value="1" {{ old('publish', '1') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('publish') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('publish') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Submit
            </button>
           <!-- </div> -->
        </div> 
      </div>
    </div> 
  </form>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('admin/js/jquery.blockUI.js') }}"></script>
<script type="text/javascript">
var type = document.getElementById('type').value;
if (type == 'none' || type == 'routes' || type == 'link')
{
    document.getElementById('title_section').style.display = 'inline';
    if (type == 'none')
    {
        document.getElementById('url').value = '';
        document.getElementById('url_section').style.display = 'none';
    } else if (type == 'routes' || type == 'link')
    {
        document.getElementById('url_section').style.display = 'inline';
    }
} else
{
    document.getElementById('title').value = '';
    document.getElementById('title_section').style.display = 'none';
    document.getElementById('url').value = '';
    document.getElementById('url_section').style.display = 'none';
}

function changeType(type)
{   
    $.blockUI({css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        },
        message: '<h1>Please Wait...</h1>'
    });


    if (type == 'none' || type == 'routes' || type == 'link')
    {
        document.getElementById('title_section').style.display = 'inline';
        if (type == 'none')
        {
            document.getElementById('url').value = '';
            document.getElementById('url_section').style.display = 'none';
        } else if (type == 'routes' || type == 'link')
        {
            document.getElementById('url_section').style.display = 'inline';
        }
    } else
    {
        document.getElementById('title').value = '';
        document.getElementById('title_section').style.display = 'inline';
        document.getElementById('url').value = '';
        document.getElementById('url_section').style.display = 'none';
    }

    $.post("change-type-create", {type: type, _token:'{!! csrf_token() !!}'}, function (data)
    {
        if (data != '' || data != undefined || data != null)
        {
            $('#group').html(data);
            setTimeout($.unblockUI);
        }
    });
}


function updateRoute(route)
{
    document.getElementById('url').value = route;
}

function searchByTitle(type, search_txt)
{
    if (!search_txt)
    {
        document.getElementById('url').value = '';
        setTimeout($.unblockUI);
    }

    $.post("search-by-title-create", {type: type, search_txt: search_txt, _token:'{!! csrf_token() !!}'}, 

        function (data)
    {
        if (data != '' || data != undefined || data != null)
        {
            $('#search_result').html(data);
        }
    });
}
</script>
@endsection
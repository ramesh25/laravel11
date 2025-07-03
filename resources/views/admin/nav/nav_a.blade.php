@extends('layouts.admin.master')
@section('content')
@include('admin.partials.breadcrumb')
<<<<<<< HEAD
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
=======
<div class="items-center justify-center bg-gray-100">
    <div class="flex justify-between items-center mb-4">
      <!-- Left side: Back + Create -->
      <div class="space-x-2">
        <!-- Back Button -->
        <a href="{{ url('admin/nav') }}" class="inline-flex items-center px-4 py-2 bg-cyan-600 text-white text-sm font-medium rounded hover:bg-cyan-700 transition">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
          </svg>
          Back
        </a>
      </div>
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

    <form action="{{ route('nav.store') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-6xl">
>>>>>>> bfd01890a1eee70204516a04d52148c71f01ee89
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6"> 
      <!-- Left Column (8 cols) -->
      <div class="md:col-span-8">
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Nav Information</h2>
              <!-- Parent -->
            <div class="mb-4 md:flex md:items-start">
                <label for="parent_id" class="md:w-1/4 font-medium text-gray-700">Parent</label>
                <div class="w-full sm:w-3/4 px-3">
                    <?php
                    $options = array(0 => 'None') + TreeHelper::selectOptions('navs', $base_id = 0, $id = null, $terms = null, $order_by = 'title', $order = 'asc');
                    ?>
                    <select name="parent_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($options as $value => $label)
                            <option value="{{ $value }}" {{ $parent_id == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('parent_id'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('parent_id') }}</div>
                    @endif
                </div>
            </div>
            <!-- Type -->
            <div class="mb-4 md:flex md:items-start">
                <label for="type" class="md:w-1/4 font-medium text-gray-700">Type</label>
                <div class="w-full sm:w-3/4 px-3">
                    <?php
                    $options = [
                        '' => '- - - Select - - -',
                        'none' => 'None',
                        'pages' => 'Pages',
                        'products' => 'Products',
                        'routes' => 'Routes',
                        'link' => 'Link',
                    ];
                    ?>
                    <select id="type" name="type" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="changeType(this.value)">
                        @foreach($options as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('type'))
                        <div class="text-red-500 text-sm mt-1">{{ $errors->first('type') }}</div>
                    @endif
                </div>
            </div>
            <!-- Type Partial -->
            <div class="partial_group" id="group">
                @include('admin.nav.nav_type_partial_a') 
            </div>
            <!-- Title -->
            <div id="title_section" class="mb-4 md:flex md:items-start">
              <label for="title" class="md:w-1/4 font-medium text-gray-700">Title</label>
              <div class="md:w-3/4">
                <input type="text" name="title" id="title" placeholder="Title"
                  value="{{ old('title') }}"
                  class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                @error('title')
                  <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <!-- URL -->
            <div id="url_section" class="mb-4 md:flex md:items-start">
                <label for="url" class="md:w-1/4 font-medium text-gray-700">Url</label>
                <div class="md:w-3/4">
                    <input type="text" name="url" id="url" placeholder="Url"
                  value="{{ old('url') }}"
                  class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                    @error('url')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Target -->
            <div class="mb-4 md:flex md:items-center">
                <label for="target" class="md:w-1/4 font-medium text-gray-700">New Page</label>
                <div class="md:w-3/4 flex gap-6">
                <label class="inline-flex items-center">
                    <input type="radio" name="target" value="1" {{ old('target') }} class="form-radio text-blue-600">
                    <span class="ml-2 text-gray-700">Yes</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="target" value="0" {{ old('target') }} class="form-radio text-blue-600">
                    <span class="ml-2 text-gray-700">No</span>
                </label>
            </div>

            </div>
            <!-- Right Section -->
            <!-- <div class="bg-white p-6 rounded shadow"> -->
            <div class="mb-4 md:flex md:items-start">
                <label for="publish" class="md:w-1/4 font-medium text-gray-700">Status</label>
                <div class="md:w-3/4">
                    <select name="publish" id="publish" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
                    <option value="1" {{ old('publish') }}>Active</option>
                    <option value="0" {{ old('publish') }}>Inactive</option>
                    </select>
                    @error('publish')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
              </div>
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
@section('script')
<script type="text/javascript">
var type = document.getElementById('type').value;
if (type == 'none' || type == 'routes' || type == 'link')
{
    document.getElementById('title_section').style.display = 'flex';
    if (type == 'none')
    {
        document.getElementById('url').value = '';
        document.getElementById('url_section').style.display = 'none';
    } else if (type == 'routes' || type == 'link')
    {
        document.getElementById('url_section').style.display = 'flex';
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
        document.getElementById('title_section').style.display = 'flex';
        if (type == 'none')
        {
            document.getElementById('url').value = '';
            document.getElementById('url_section').style.display = 'none';
        } else if (type == 'routes' || type == 'link')
        {
            document.getElementById('url_section').style.display = 'flex';
        }
    } else
    {
        document.getElementById('title').value = '';
        document.getElementById('title_section').style.display = 'flex';
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
<script type="text/javascript" src="{{ asset('admin/js/jquery.blockUI.js') }}"></script>
@endsection
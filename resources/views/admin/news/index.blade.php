@extends('layouts.admin.master')
@section('content')
@include('admin.partials.breadcrumb')
<div class="flex justify-between items-center mb-4">
  <!-- Left side: Back + Create -->
  <div class="space-x-2">
    <!-- Back Button -->
    <a href="{{ url('admin/news') }}" class="inline-flex items-center px-4 py-2 bg-cyan-600 text-white text-sm font-medium rounded hover:bg-cyan-700 transition">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>
      Back
    </a>

    <!-- Create Button -->
    <a href="{{ route('news.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
      </svg>
      Create News
    </a>
  </div>

  <!-- Right side: Dropdown Action Button -->
  <div class="relative inline-block text-left">
    <button onclick="toggleActionDropdown()" class="inline-flex justify-center w-full px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-cyan-600 transition">
      Action
      <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.586l3.71-4.356a.75.75 0 011.14.98l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
      </svg>
    </button>

    <div id="actionDropdown" class="hidden absolute right-0 mt-2 w-40 bg-white border rounded shadow-lg z-50">
      <a href="javascript:void(0);" onclick="return actionSubmit('{{ url('admin/news/update-publish/1') }}');" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Publish</a>
      <a href="javascript:void(0);" onclick="return actionSubmit('{{ url('admin/news/update-publish/0') }}');" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">Unpublish</a>
      <a href="javascript:void(0);" onclick="return actionConfirm('{{ url('admin/news/bulk_delete') }}','Delete');" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100" role="menuitem">Delete</a>
    </div>
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

<!-- Table Card Component -->
<div class="bg-white shadow rounded-lg p-6">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold text-gray-700">News List</h2>
    <input type="text" id="tableSearch" onkeyup="filterTableAndResetPagination()" placeholder="Search..." class="border px-3 py-1 rounded focus:outline-none focus:ring w-1/3">
  </div>
  @if(count($models)>0)
  <div class="overflow-x-auto">
    <form id="frmListing" method="POST">
    @csrf
    <table class="min-w-full divide-y divide-gray-200" id="userTable">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            <input type="checkbox" name="select-all" id="select-all" class="rounded border-gray-300" onclick="toggleSelect()">
          </th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
          <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
        @foreach($models as $key => $m)
        <tr>
          <td class="px-4 py-2">{{ ++$key }} <input type="checkbox" name="ids[]" value="{{ $m->id }}" class="rounded border-gray-300"></td>
          <td class="px-4 py-2">{{ $m->title }}</td>
          <td class="px-4 py-2">
            <img src="{{ asset($m->image) }}" class="w-20 h-10" alt="User">
          </td>
          <td class="px-4 py-2 text-right space-x-2">
            <a href="{{ route('news.edit',$m->id) }}" class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">Edit</a>
            {!! $publish[$m->publish] !!}
            <a title="Delete Item" onclick="javascript:return confirm('Are you sure to delete ?')" href="{{ url('admin/news/single-delete', $m->id) }}" class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600"><i class="mdi mdi-delete"></i>Delete</a>
          </td>
        </tr>
        @endforeach
        <!-- More rows can be added here -->
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="flex justify-between items-center mt-4">
    <span class="text-sm text-gray-600">Showing <span id="pageStart">1</span> to <span id="pageEnd">2</span> of <span id="totalRows">2</span> entries</span>
    <div class="space-x-1">
      <button onclick="changePage(-1)" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Previous</button>
      <button onclick="changePage(1)" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Next</button>
    </div>
  </div>
  @endif
</div>

@endsection
@section('script')
<script src="{{ asset('admin/assets/js/common.js') }}"></script>
@endsection
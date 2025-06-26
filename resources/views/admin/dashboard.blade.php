@extends('layouts.admin.master')
@section('content')
@include('admin.partials.breadcrumb')
 <!-- Card Component -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
  <!-- Card 1 -->
  <div class="bg-white shadow rounded-lg p-5">
    <div class="flex items-center justify-between mb-3">
      <h6 class="text-sm text-gray-500 font-medium">Total Page Views</h6>
      <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553 2.276a1 1 0 010 1.788L15 16" />
      </svg>
    </div>
    <h4 class="text-2xl font-semibold mb-2">
      4,42,236
      <span class="ml-2 text-sm text-blue-700 bg-blue-100 border border-blue-500 rounded-full px-2 py-0.5 inline-flex items-center">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
        59.3%
      </span>
    </h4>
    <p class="text-sm text-gray-500">You made an extra <span class="text-blue-600 font-medium">35,000</span> this year</p>
  </div>

  <!-- Card 2 -->
  <div class="bg-white shadow rounded-lg p-5">
    <div class="flex items-center justify-between mb-3">
      <h6 class="text-sm text-gray-500 font-medium">Files</h6>
      <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h4m4-8v-4a2 2 0 00-2-2H8l-4 4v8a2 2 0 002 2h2" />
      </svg>
    </div>
    <h4 class="text-2xl font-semibold mb-2">15,200</h4>
    <p class="text-sm text-gray-500">Total file uploads this month</p>
  </div>

  <!-- Card 3 -->
  <div class="bg-white shadow rounded-lg p-5">
    <div class="flex items-center justify-between mb-3">
      <h6 class="text-sm text-gray-500 font-medium">Folders</h6>
      <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v13a2 2 0 002 2h14a2 2 0 002-2V7H3zm3-4h4l2 2h8a2 2 0 012 2v1H3V7a2 2 0 012-2z" />
      </svg>
    </div>
    <h4 class="text-2xl font-semibold mb-2">1,234</h4>
    <p class="text-sm text-gray-500">Active folders in your system</p>
  </div>

  <!-- Card 4 -->
  <div class="bg-white shadow rounded-lg p-5">
    <div class="flex items-center justify-between mb-3">
      <h6 class="text-sm text-gray-500 font-medium">Image Uploads</h6>
      <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M3 19h18M4 8h16M4 16h16M10 12l4-4 4 4" />
      </svg>
    </div>
    <h4 class="text-2xl font-semibold mb-2">7,890</h4>
    <p class="text-sm text-gray-500">Images added in the last 30 days</p>
  </div>
</div>

<!-- Table Card Component -->
<div class="bg-white shadow rounded-lg p-6 mt-8">
  <div class="flex justify-between items-center mb-4">
    <h2 class="text-lg font-semibold text-gray-700">User List</h2>
    <input type="text" id="tableSearch" onkeyup="filterTableAndResetPagination()" placeholder="Search..." class="border px-3 py-1 rounded focus:outline-none focus:ring w-1/3">
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200" id="userTable">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            <input type="checkbox" id="selectAll" onclick="toggleAllCheckboxes(this)">
          </th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
          <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200" id="tableBody">
        <tr>
          <td class="px-4 py-2"><input type="checkbox" class="rowCheckbox"></td>
          <td class="px-4 py-2">John Doe</td>
          <td class="px-4 py-2">
            <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="User">
          </td>
          <td class="px-4 py-2">Admin</td>
          <td class="px-4 py-2 text-right space-x-2">
            <button class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">Edit</button>
            <button class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Delete</button>
          </td>
        </tr>
        <tr>
          <td class="px-4 py-2"><input type="checkbox" class="rowCheckbox"></td>
          <td class="px-4 py-2">Jane Smith</td>
          <td class="px-4 py-2">
            <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="User">
          </td>
          <td class="px-4 py-2">Editor</td>
          <td class="px-4 py-2 text-right space-x-2">
            <button class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">Edit</button>
            <button class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Delete</button>
          </td>
        </tr>
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
</div>

@endsection
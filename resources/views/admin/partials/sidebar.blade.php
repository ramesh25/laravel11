<div id="sidebar" class="fixed md:static top-0 left-0 w-64 bg-white h-screen shadow-lg transform md:translate-x-0 -translate-x-full transition-transform duration-200 z-30">
  <!-- Close button (mobile only) -->
  <div class="md:hidden flex justify-end p-2">
    <button onclick="toggleSidebar()" class="text-gray-600 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>
  <div class="p-4 text-lg font-bold border-b">Admin Panel</div>
    
    <nav class="p-4 space-y-2">
      @can('dashboard')
      <a href="{{ url('admin/dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Dashboard</a>
      @endcan
      @can('menu')
      <a href="{{ url('admin/nav') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Menu</a>
      @endcan
      @can('category')
      <a href="{{ url('admin/category') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Category</a>
      @endcan
      @can('advertise')
      <a href="{{ url('admin/advertise') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Advertise</a>
      @endcan
      @can('admin')
      <a href="{{ url('admin/admin') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Admin</a>
      @endcan
      @can('page')
      <a href="{{ url('admin/page') }}" class="block px-4 py-2 rounded hover:bg-gray-200">Page</a>
      @endcan
      @can('news')
      <a href="{{ url('admin/news') }}" class="block px-4 py-2 rounded hover:bg-gray-200">News</a>
      @endcan
     
      <!-- Dropdown -->
      <div>
        <button onclick="toggleDropdown('settingDropdown')" class="w-full text-left px-4 py-2 rounded hover:bg-gray-200">Setting ▼</button>
        <div id="settingDropdown" class="ml-4 mt-1 space-y-1 hidden">
           @can('role')
          <a href="{{ url('admin/roles') }}" class="block px-4 py-1 rounded hover:bg-gray-200">Roles</a>
           @endcan
           @can('setting')
          <a href="{{ url('admin/setting') }}" class="block px-4 py-1 rounded hover:bg-gray-200">Setting</a>
           @endcan
           @can('social')
          <a href="{{ url('admin/social') }}" class="block px-4 py-1 rounded hover:bg-gray-200">Social</a>
           @endcan
        </div>
      </div>
    </nav>
    
</div>
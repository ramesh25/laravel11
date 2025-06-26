<header class="flex justify-between items-center bg-white shadow px-4 py-3">
  <div class="flex items-center space-x-2">
    <button onclick="toggleSidebar()" class="md:hidden text-gray-600 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>
    <form class="hidden md:block">
      <input type="text" placeholder="Search..." class="border rounded px-3 py-1 focus:outline-none focus:ring"/>
    </form>
  </div>

  <!-- Right icons -->
  <div class="flex items-center space-x-4">
    <!-- Notification Icon -->
    <button class="text-gray-600 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
      </svg>
    </button>

    <!-- Profile Dropdown -->
    <div class="relative">
      <button onclick="toggleDropdown('profileDropdown')" class="focus:outline-none">
        <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-full w-10 h-10"/>
      </button>
      <div id="profileDropdown" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-md hidden z-40">
        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block px-4 py-2 hover:bg-gray-100">Logout</button>
        </form>
      </div>
    </div>
  </div>
</header>
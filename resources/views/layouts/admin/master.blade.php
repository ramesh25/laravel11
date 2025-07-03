<!DOCTYPE html>
<html lang="en">
@include('admin.partials.head')
<body class="bg-gray-100 min-h-screen flex">

  <!-- Sidebar -->
  @include('admin.partials.sidebar')

  <!-- Main content -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    @include('admin.partials.header')

    <!-- Page Content -->
    <main class="p-4">
      @yield('content')
    </main>
  </div>
  @include('admin.partials.footer')
<script src="{{ asset('admin/assets/js/jquery-3.6.1.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/admin.js') }}"></script>
  @yield('script')
</body>
</html>

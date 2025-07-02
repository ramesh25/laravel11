<!-- [ breadcrumb ] start -->
<nav class="flex items-center text-sm text-gray-600 mb-6" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <!-- Home -->
    <li class="inline-flex items-center">
      <a href="/" class="inline-flex items-center text-gray-600 hover:text-blue-600">
        <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 2L2 8h2v8h4v-4h4v4h4V8h2L10 2z" />
        </svg>
        Dashboard
      </a>
    </li>

    <!-- Divider -->
    <li>
      <div class="flex items-center">
        <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M7.05 4.05a.5.5 0 000 .707L11.293 9.5 7.05 13.743a.5.5 0 00.707.707l4.95-4.95a1 1 0 000-1.414l-4.95-4.95a.5.5 0 00-.707 0z" />
        </svg>
        <a href="#" class="text-gray-600 hover:text-blue-600">{!! $bredcrumb !!}</a>
      </div>
    </li>

    <!-- Current Page -->
    <li aria-current="page">
      <div class="flex items-center">
        <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M7.05 4.05a.5.5 0 000 .707L11.293 9.5 7.05 13.743a.5.5 0 00.707.707l4.95-4.95a1 1 0 000-1.414l-4.95-4.95a.5.5 0 00-.707 0z" />
        </svg>
        <span class="text-gray-500">Add</span>
      </div>
    </li>
    
  </ol>
</nav>
<!-- [ breadcrumb ] end -->
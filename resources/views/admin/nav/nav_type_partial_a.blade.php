<?php
use Illuminate\Support\Facades\Request;
if (!Request::ajax()) {
    $type =old('type');
}
?>
@if ($type == 'pages')
<div class="mb-4 md:flex md:items-start">
    <label for="type_id" class="md:w-1/4 font-medium text-gray-700">
    Select Contents <span class="text-red-500">*</span>
    </label>

    <div class="md:w-1/4">
        <select name="type_id[]" id="type_id" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
          @foreach(\App\Models\Page::pluck('title', 'id') as $id => $title)
            <option value="{{ $id }}" {{ in_array($id, old('type_id', [])) ? 'selected' : '' }}>
              {{ $title }}
            </option>
          @endforeach
        </select>
        @error('type_id')
          <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:w-1/4 mt-4 md:mt-0 md:ml-4">
        <input type="text" name="search_txt" placeholder="Search..." onkeyup='searchByTitle("pages", this.value);' class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
    </div>
</div>
@elseif ($type == 'categories')
<div class="mb-4 md:flex md:items-start">
    <label for="type_id" class="md:w-1/4 font-medium text-gray-700">
    Select Contents <span class="text-red-500">*</span>
    </label>

    <div class="md:w-1/4">
        <select name="type_id[]" id="type_id" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
          @foreach(\App\Models\Category::pluck('title', 'id') as $id => $title)
            <option value="{{ $id }}" {{ in_array($id, old('type_id', [])) ? 'selected' : '' }}>
              {{ $title }}
            </option>
          @endforeach
        </select>
        @error('type_id')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:w-1/4 mt-4 md:mt-0 md:ml-4">
        <input type="text" name="search_txt" placeholder="Search..." onkeyup='searchByTitle("categories", this.value);' class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
    </div>
</div>

@elseif ($type == 'routes')
<div class="mb-4 md:flex md:items-start">
  <label for="type_id" class="md:w-1/3 font-medium text-gray-700">
    Select Contents <span class="text-red-500">*</span>
  </label>
    <?php
        $options = array(
            '' => '- - - Select - - -',
            '/' => 'Home',
            'contact-us' => 'Contact Us',
            'pages' => 'Pages',
            'categories' => 'Categories',
        );
    ?>
  <div class="md:w-2/3">
    <select name="type_id" id="type_id"
      onchange="updateRoute(this.value);"
      class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"
    >
       @foreach ($options as $id => $title)
            <option value="{{ $id }}">{{ $title }}</option>
        @endforeach
    </select>

    @error('type_id')
      <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
  </div>
</div>


@elseif ($type=='none')

@endif
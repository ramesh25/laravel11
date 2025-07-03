<?php
use Illuminate\Support\Facades\Request;
// Determine type
    if (!Request::ajax()) {
        $type = old('type', $model->type ?? '');
    }

    $selectedTypeId = old('type_id', $model->type_id ?? null);
?>
@if ($type === 'pages')
    <div class="mb-4 flex gap-4">
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Select Page</label>
            <div id="search_result">
                <select name="type_id" class="w-full border rounded px-4 py-2">
                    @foreach (\App\Models\Page::pluck('title', 'id') as $id => $title)
                        <option value="{{ $id }}" {{ $selectedTypeId == $id ? 'selected' : '' }}>{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input type="text" name="search_txt" onkeyup="searchByTitle('pages', this.value)" class="w-full border rounded px-4 py-2" placeholder="Search..." />
        </div>
    </div>

@elseif ($type === 'categories')
    @php
            $routes = [
                '' => '-- Select --',
                '/' => 'Home',
                'contact-us' => 'Contact Us',
                'pages' => 'Pages',
                'categories' => 'Categories',
                'sale-properties' => 'Sale Properties',
                'rental-properties' => 'Rental Properties',
            ];
        @endphp

    <div class="mb-4 flex gap-4">
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Select Category</label>
            <div id="search_result">
                <select name="type_id" class="w-full border rounded px-4 py-2">
                    @foreach (\App\Models\Category::pluck('title', 'id') as $id => $title)
                        <option value="{{ $id }}" {{ $selectedTypeId == $id ? 'selected' : '' }}>{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input type="text" name="search_txt" onkeyup="searchByTitle('categories', this.value)" class="w-full border rounded px-4 py-2" placeholder="Search..." />
        </div>
    </div>

@elseif ($type === 'routes')
 <?php
            $options = array(
                '' => '- - - Select - - -',
                '/' => 'Home',
                'contact-us' => 'Contact Us',
                'pages' => 'Pages',
                'categories' => 'Categories',
                'blogs' => 'Blogs',
                'sale-properties' => 'Sale Properties',
                'rental-properties' => 'Rental Properties',
            );
            ?>
    <div class="mb-4 flex gap-4">
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Select Route</label>
            <div id="search_result">
                <select name="type_id" class="w-full border rounded px-4 py-2" onchange="updateRoute(this.value)">
                    @foreach ($options as $id => $title)
                        <option value="{{ $id }}" {{ $selectedTypeId == $id ? 'selected' : '' }}>{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input type="text" name="search_txt" onkeyup="searchByTitle('categories', this.value)" class="w-full border rounded px-4 py-2" placeholder="Search..." />
        </div>
    </div>

@elseif ($type === 'link')
    <div id="url_section" 
     class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Custom Link URL</label>
        <input type="text" name="url" 
        value="{{ old('url', $model->url ?? '') }}" 
        id="url" 
        class="w-full border rounded px-4 py-2">
    </div>

@elseif ($type === 'none')
    <!-- No additional fields needed -->
@endif
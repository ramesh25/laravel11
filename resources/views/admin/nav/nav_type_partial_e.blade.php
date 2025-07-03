<?php
use Illuminate\Support\Facades\Request;
if (!Request::ajax())
{
	$type = Request::old('type') ? Request::old('type'): $model->type;
}
?>
@if ($type == 'pages')
    <div class="mb-4 flex gap-4">
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Select Page</label>
            <div id="search_result">
                <select name="type_id[]" class="w-full border rounded px-4 py-2">
                    @foreach (\App\Models\Page::pluck('title', 'id') as $id => $title)
                        <option value="{{ old('id', $model->id) }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input type="text" name="search_txt" onkeyup="searchByTitle('pages', this.value)" class="w-full border rounded px-4 py-2" placeholder="Search..." />
        </div>
    </div>
@elseif ($type == 'categories')
    <div class="mb-4 flex gap-4">
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Select Category</label>
            <div id="search_result">
                <select name="type_id[]" class="w-full border rounded px-4 py-2">
                    @foreach (\App\Models\Category::pluck('title', 'id') as $id => $title)
                        <option value="{{ old('id', $model->id) }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-1/2">
            <label class="block text-sm font-medium text-gray-700">Search</label>
            <input type="text" name="search_txt" onkeyup="searchByTitle('categories', this.value)" class="w-full border rounded px-4 py-2" placeholder="Search..." />
        </div>
    </div>
    
@elseif ($type == 'routes')
<div class="mb-4 flex gap-4">
    <div class="w-1/2">
        <label class="block text-sm font-medium text-gray-700">Select Contents</label>
        <?php
            $options = array(
                '' => '- - - Select - - -',
                '/' => 'Home',
                'contact-us' => 'Contact Us',
                'pages' => 'Pages',
                'categories' => 'Categories',
                'sale-properties' => 'Sale Properties',
                'rental-properties' => 'Rental Properties',
            );
            ?>
        <div id="search_result">
            <select name="type_id[]" class="w-full border rounded px-4 py-2">
                @foreach ($options as $id => $title)
                    <option value="{{ old('id', $model->id) }}">{{ $title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="w-1/2">
        <label class="block text-sm font-medium text-gray-700">Search</label>
        <input type="text" name="search_txt" onkeyup="searchByTitle('categories', this.value)" class="w-full border rounded px-4 py-2" placeholder="Search..." />
    </div>
</div>

@elseif ($type=='none')

@endif
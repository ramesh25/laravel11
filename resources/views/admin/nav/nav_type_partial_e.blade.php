<?php
use Illuminate\Support\Facades\Request;
if (!Request::ajax())
{
    $type = Input::old('type') ? Input::old('type'): $model->type;
}
?>
@if ($type=='pages')
<div class="flex flex-wrap -mx-3 mb-6">
    <label for="exampleInputType1" class="w-full sm:w-1/3 px-3 mb-2 sm:mb-0 text-gray-700 font-medium">Select Contents <span class="text-red-500">*</span></label>
    <div class="w-full sm:w-1/3 px-3">
        <span id="search_result">
            <select name="type_id[]" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach(\App\Models\Page::pluck('title', 'id') as $id => $title)
                    <option value="{{ $id }}">{{ $title }}</option>
                @endforeach
            </select>
            @if ($errors->has('type_id'))
                <span class="text-red-500 text-sm">{{ $errors->first('type_id') }}</span>
            @endif
        </span>
    </div>
    <div class="w-full sm:w-1/3 px-3">
        <input type="text" name="search_txt" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search..." onkeyup="searchByTitle('pages', this.value);">
    </div>
</div>
@elseif ($type=='categories')
<div class="flex flex-wrap -mx-3 mb-6">
    <label for="exampleInputType2" class="w-full sm:w-1/3 px-3 mb-2 sm:mb-0 text-gray-700 font-medium">Select Contents <span class="text-red-500">*</span></label>
    <div class="w-full sm:w-1/3 px-3">
        <span id="search_result">
            <select name="type_id[]" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach(\App\Models\Category::pluck('title', 'id') as $id => $title)
                    <option value="{{ $id }}">{{ $title }}</option>
                @endforeach
            </select>
            @if ($errors->has('type_id'))
                <span class="text-red-500 text-sm">{{ $errors->first('type_id') }}</span>
            @endif
        </span>
    </div>
    <div class="w-full sm:w-1/3 px-3">
        <input type="text" name="search_txt" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search..." onkeyup="searchByTitle('categories', this.value);">
    </div>
</div>
@elseif ($type=='routes')
<div class="flex flex-wrap -mx-3 mb-6">
    <label for="exampleInputRoute" class="w-full sm:w-1/3 px-3 mb-2 sm:mb-0 text-gray-700 font-medium">Select Contents <span class="text-red-500">*</span></label>
    <div class="w-full sm:w-2/3 px-3">
        <?php
        $options = [
            '' => '- - - Select - - -',
            '/' => 'Home',
            'contact-us' => 'Contact Us',
            'pages' => 'Pages',
            'categories' => 'Categories',
        ];
        ?>
        <select name="type_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="updateRoute(this.value);">
            @foreach($options as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </select>
        @if ($errors->has('type_id'))
            <span class="text-red-500 text-sm">{{ $errors->first('type_id') }}</span>
        @endif
    </div>
</div>

@endif

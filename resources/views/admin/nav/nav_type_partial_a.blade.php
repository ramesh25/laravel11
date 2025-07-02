<?php
use Illuminate\Support\Facades\Request;
if (!Request::ajax()) {
    $type =old('type');
}
?>
@if ($type=='pages')
<div class="mb-4">
    <label for="exampleInputType1" class="col-sm-4 col-form-label">Select Contents <span>*</span></label>
    <div class="col-span-4">
        <select name="type_id[]" class="w-full border rounded px-4 py-2">
            @foreach(\App\Models\Page::pluck('title', 'id') as $id => $title)
                <option value="{{ $id }}">{{ $title }}</option>
            @endforeach
        </select>
        @error('type_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
    <!-- <div class="col-sm-4">
        <span id="search_result">
            {{  Form::select('type_id[]', \App\Models\Page::pluck('title', 'id'), null, ['class'=>'form-control']) }}
            {!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
        </span>
    </div> -->
    <div class="col-span-5">
        <input type="text" name="search_txt" placeholder="Search..." class="w-full border rounded px-4 py-2" onkeyup="searchByTitle('pages', this.value);">
    </div>
    <!-- <div class="col-sm-4">
         {{ Form::text('search_txt', null, array('class'=>'form-control', 'placeholder'=>'Search...', 'onkeyup'=>'searchByTitle("pages", this.value);')) }}
    </div> -->
</div>
@elseif ($type=='categories')
<div class="mb-4">
    <label class="col-span-3 text-sm font-medium text-gray-700">Select Contents <span class="text-red-500">*</span></label>
    <div class="col-span-4">
        <select name="type_id[]" class="w-full border rounded px-4 py-2">
            @foreach(\App\Models\Category::pluck('title', 'id') as $id => $title)
                <option value="{{ $id }}">{{ $title }}</option>
            @endforeach
        </select>
        @error('type_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
    <!-- <label for="exampleInputType2" class="col-sm-4 col-form-label">Select Contents <span>*</span></label>
        <div class="col-md-4">
            <span id="search_result">
                {{  Form::select('type_id[]', \App\Models\Category::pluck('title', 'id'), null, ['class'=>'form-control']) }}
                {!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
            </span>
        </div> -->
        <div class="col-span-5">
        <input type="text" name="search_txt" placeholder="Search..." class="w-full border rounded px-4 py-2" onkeyup="searchByTitle('categories', this.value);">
        </div>
        <!-- <div class="col-md-4">
             {{ Form::text('search_txt', null, array('class'=>'form-control', 'placeholder'=>'Search...', 'onkeyup'=>'searchByTitle("categories", this.value);')) }}
        </div> -->
</div>
@elseif ($type=='blogs')
<div class="mb-4">
    <label for="exampleInputType2" class="col-sm-4 col-form-label">Select Contents <span>*</span></label>
        <div class="col-md-4">
            <span id="search_result">
                {{  Form::select('type_id[]', \App\Models\Blog::pluck('title', 'id'), null, ['class'=>'form-control']) }}
                {!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
            </span>
        </div>
        <div class="col-md-4">
             {{ Form::text('search_txt', null, array('class'=>'form-control', 'placeholder'=>'Search...', 'onkeyup'=>'searchByTitle("blogs", this.value);')) }}
        </div>
</div>
@elseif ($type=='routes')
<div class="mb-4">
    <label for="exampleInputRoute" class="col-sm-4 col-form-label">Select Contents <span>*</span></label>
    <div class="col-sm-8">
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
            {{  Form::select('type_id[]', $options , null, array('class'=>'form-control', 'onchange'=>'updateRoute(this.value);')) }}
            {!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
    </div>
</div>
@elseif ($type=='link')

@elseif ($type=='none')

@endif
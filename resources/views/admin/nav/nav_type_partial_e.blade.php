<?php
use Illuminate\Support\Facades\Request;
if (!Request::ajax())
{
	$type = Request::old('type') ? Request::old('type'): $model->type;
}
?>
@if ($type=='pages')
<div class="form-group row">
    <label for="exampleInputType1" class="col-sm-4 col-form-label">Select Contents <span>*</span></label>
    <div class="col-sm-4">
        <span id="search_result">
            {{  Form::select('type_id', \App\Models\Page::pluck('title', 'id'), null, ['class'=>'form-control']) }}
            {!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
        </span>
    </div>
    <div class="col-sm-4">
         {{ Form::text('search_txt', null, array('class'=>'form-control', 'placeholder'=>'Search...', 'onkeyup'=>'searchByTitle("pages", this.value);')) }}
    </div>
</div>
@elseif ($type=='categories')
<div class="form-group row">
    <label for="exampleInputType2" class="col-sm-4 col-form-label">Select Contents <span>*</span></label>
        <div class="col-md-4">
            <span id="search_result">
                {{  Form::select('type_id', \App\Models\Category::pluck('title', 'id'), null, ['class'=>'form-control']) }}
                {!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
            </span>
        </div>
        <div class="col-md-4">
             {{ Form::text('search_txt', null, array('class'=>'form-control', 'placeholder'=>'Search...', 'onkeyup'=>'searchByTitle("categories", this.value);')) }}
        </div>
</div>
@elseif ($type=='blogs')
<div class="form-group row">
    <label for="exampleInputType2" class="col-sm-4 col-form-label">Select Contents <span>*</span></label>
        <div class="col-md-4">
            <span id="search_result">
                {{  Form::select('type_id', \App\Models\Blog::pluck('title', 'id'), null, ['class'=>'form-control']) }}
                {!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
            </span>
        </div>
        <div class="col-md-4">
             {{ Form::text('search_txt', null, array('class'=>'form-control', 'placeholder'=>'Search...', 'onkeyup'=>'searchByTitle("blogs", this.value);')) }}
        </div>
</div>
@elseif ($type=='routes')
<div class="form-group row">
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
            {{  Form::select('type_id', $options , null, array('class'=>'form-control', 'onchange'=>'updateRoute(this.value);')) }}
            {!! $errors->first('type_id', '<span class="help-block">:message</span>') !!}
    </div>
</div>

@endif

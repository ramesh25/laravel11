<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use BredcrumpHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    private $title = 'Category';
    private $controller = 'admin/category';
    private $table = 'categories';
    private $listing_page = 'admin.category.index';
    private $create_form = 'admin.category.category_add';
    private $update_form = 'admin.category.category_edit';
    private $remember_page = 'category_parent_id';

    private $publish = array(
    '0'=>'<span class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Inactive</span>', 
    '1'=>'<span class="px-3 py-1 bg-cyan-600 text-white text-xs rounded hover:bg-cyan-600">Active</span>',
    );
    
    public function index()
    {
        $title = $this->title. ' Management';
        $bredcrumb = $this->title;
        Cache::forget($this->remember_page);
        $publish = $this->publish;

        $models = Category::with('childs')
        ->whereIn('parent_id', array(0))
        ->orderBy('position', 'desc')
        ->paginate(10);

        return view($this->listing_page, compact('title', 'models', 'bredcrumb', 'publish', 'title'));
    }

    public function child($id) {

        $title = $this->title;
        $publish = $this->publish;

        //for return page
        Cache::forever($this->remember_page, $id);
        
        $models = Category::with('childs')
                ->where('parent_id', $id)
                ->orderBy('position', 'desc')
                ->paginate(10);
        $parent_id = $id;
        return view($this->listing_page, compact('title', 'publish', 'models', 'parent_id'));
    }

    public function create()
    {
        $title = $this->title. ' Create';
        $parent_id = Cache::get($this->remember_page) ? Cache::get($this->remember_page) : null;
        $bredcrumb = 'Cagetory';
        $bredcrumb .= ' / Create';
        $publish = $this->publish;
        return view($this->create_form, compact('title','parent_id', 'bredcrumb', 'publish'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $model = new Category();

        $model->title = $request['title'];
        $model->parent_id = $request['parent_id'];
        $model->slug = Str::slug($request['title']);
        $model->description = $request['description'];
        $model->display_home = $request['display_home'];
        $model->meta_title = $request['meta_title'];
        $model->meta_keywords = $request['meta_keywords'];
        $model->meta_description = $request['meta_description'];
        $model->publish = $request['publish'];

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = Str::slug($request->get('title')) . time() . '.' . $extension;
            $folder = 'uploads/category/';
            $request->file('image')->move($folder, $image);
            $model->image = $folder . $image;
        }

        $model->save();

        if (Cache::get($this->remember_page))
            return Redirect::to($this->controller . '/child/' . Cache::get($this->remember_page))->with('success', '<span>Record has been Successfully Created</span>');
        else
            return redirect()->back()->with('success', '<span>1 ' . CREATED . '</span>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = $this->title. ' Edit';
        $parent_id = null;
        $bredcrumb = $this->title;
        $bredcrumb .= ' / Update';

        $model = Category::find($id);
        return view($this->update_form, compact('title','parent_id', 'bredcrumb', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // dd($request->all());
        $model = Category::find($id);
      
        $model->title = $request['title'];
        $model->parent_id = $request['parent_id'];
        $model->slug = Str::slug($request['title']);
        $model->publish = $request['publish'];
        $model->description = $request['description'];
        $model->display_home = $request['display_home'];
        $model->meta_title = $request['meta_title'];
        $model->meta_keywords = $request['meta_keywords'];
        $model->meta_description = $request['meta_description'];

        $folder= 'uploads/category/';
         if ($request->hasFile('image')) {
            if($model->image){
         \File::delete(public_path() . $folder, $model->image);  
        }
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = Str::slug($request->get('title')) . time() . '.' . $extension;
            $request->file('image')->move($folder, $image);
           $model->image = $folder.$image;
        } else if ($request->get('delete_image')) {
            if ($model->image) {
             \File::delete(public_path() . $folder, $model->image);
            }
            $model->image = '';
        }
        $model->save();
        if (Cache::get($this->remember_page))
            return Redirect::to($this->controller . '/child/' . Cache::get($this->remember_page))->with('success', '<span>Record has been Successfully Updated</span>');
        else
        return redirect()->back()->with('success', '<span>Record has been Successfully Updated</span>');
    }

    public function postUpdatePublish(Request $request, $publish) 
    {       
        
        $affected_models = Category::whereIn('id', $request->get('ids'))->update(array('publish' => $publish));
        return Redirect::back()->with('success', '<div class="success">'.$affected_models.' '.UPDATED.'</div>');        
    }


    public function bulkDelete(Request $request)
    {
        $models = Category::whereIn('id', $request->get('ids'))->get(array('image'));
        $folder= 'uploads/category/';
        foreach ($models as $m) {
            File::delete(public_path() . $folder, $m->image);
        }
       $affected_models = Category::whereIn('id', $request->get('ids'))->delete();

        return redirect()->back()->with('success', $affected_models . ' ' . DELETED);
    }


    public function destroy($id)
    {
      // dd($id);
        try {
            $model  = Category::findOrFail($id);
            $picture = $model->image;
            if ($model->delete()) {
                \File::delete($picture);
                return redirect()->back()->with('success', '<span>Record has been Successfully Deleted</span>');
            }
        } catch (Exception $e) {

        }
    }
}

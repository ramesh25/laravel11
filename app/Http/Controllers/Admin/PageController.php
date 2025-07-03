<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use BredcrumpHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    private $title = 'Page';
    private $controller = 'admin/page';
    private $table = 'pages';
    private $listing_page = 'admin.page.index';
    private $create_form = 'admin.page.page_add';
    private $update_form = 'admin.page.page_edit';

    private $publish = array(
    '0'=>'<span class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Inactive</span>', 
    '1'=>'<span class="px-3 py-1 bg-cyan-600 text-white text-xs rounded hover:bg-cyan-600">Active</span>',
    );
    
    public function index()
    {
        $title = $this->title. ' Management';
        $breadcrumb = $this->title;
        $publish = $this->publish;

        $models = Page::orderBy('position', 'desc')
        ->paginate(10);

        return view($this->listing_page, compact('title', 'models', 'breadcrumb', 'publish', 'title'));
    }


    public function create()
    {
        $title = $this->title. ' Create';
        $breadcrumb = 'Cagetory';
        $breadcrumb .= ' / Create';
        $publish = $this->publish;
        return view($this->create_form, compact('title', 'breadcrumb', 'publish'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $model = new Page();

        $model->title = $request['title'];
        $model->description = $request['description'];
        $model->meta_title = $request['meta_title'];
        $model->meta_keywords = $request['meta_keywords'];
        $model->meta_description = $request['meta_description'];
        $model->publish = $request['publish'];

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = Str::slug($request->get('title')) . time() . '.' . $extension;
            $folder = 'uploads/page/';
            $request->file('image')->move($folder, $image);
            $model->image = $folder . $image;
        }

        $model->save();

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
        $breadcrumb = $this->title;
        $breadcrumb .= ' / Update';

        $model = Page::find($id);
        return view($this->update_form, compact('title', 'breadcrumb', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        // dd($request->all());
        $model = Page::find($id);
      
        $model->title = $request['title'];
        $model->publish = $request['publish'];
        $model->description = $request['description'];
        $model->meta_title = $request['meta_title'];
        $model->meta_keywords = $request['meta_keywords'];
        $model->meta_description = $request['meta_description'];

        $folder= 'uploads/page/';
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

        return redirect()->back()->with('success', '<span>Record has been Successfully Updated</span>');
    }

    public function postUpdatePublish(Request $request, $publish) 
    {       
        
        $affected_models = Page::whereIn('id', $request->get('ids'))->update(array('publish' => $publish));
        return Redirect::back()->with('success', '<div class="success">'.$affected_models.' '.UPDATED.'</div>');        
    }


    public function bulkDelete(Request $request)
    {
        $models = Page::whereIn('id', $request->get('ids'))->get(array('image'));
        $folder= 'uploads/page/';
        foreach ($models as $m) {
            File::delete(public_path() . $folder, $m->image);
        }
       $affected_models = Page::whereIn('id', $request->get('ids'))->delete();

        return redirect()->back()->with('success', $affected_models . ' ' . DELETED);
    }


    public function destroy($id)
    {
      // dd($id);
        try {
            $model  = Page::findOrFail($id);
            $picture = $model->image;
            if ($model->delete()) {
                \File::delete($picture);
                return redirect()->back()->with('success', '<span>Record has been Successfully Deleted</span>');
            }
        } catch (Exception $e) {

        }
    }
}

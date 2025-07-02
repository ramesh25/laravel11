<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use BredcrumpHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    private $title = 'News';
    private $controller = 'admin/news';
    private $table = 'news';
    private $listing_page = 'admin.news.index';
    private $create_form = 'admin.news.news_add';
    private $update_form = 'admin.news.news_edit';

    private $publish = array(
    '0'=>'<span class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Inactive</span>', 
    '1'=>'<span class="px-3 py-1 bg-cyan-600 text-white text-xs rounded hover:bg-cyan-600">Active</span>',
    );
    
    public function index()
    {
        $title = $this->title. ' Management';
        $bredcrumb = $this->title;
        $publish = $this->publish;

        $models = News::orderBy('position', 'desc')
        ->paginate(10);

        return view($this->listing_page, compact('title', 'models', 'bredcrumb', 'publish', 'title'));
    }


    public function create()
    {
        $title = $this->title. ' Create';
        $bredcrumb = 'News';
        $bredcrumb .= ' / Create';
        $publish = $this->publish;
        return view($this->create_form, compact('title', 'bredcrumb', 'publish'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        // dd($request->all());
        $model = new News();

        $model->title = $request['title'];
        $model->description = $request['description'];
        $model->highlited_news = $request['highlited_news'];
        $model->meta_title = $request['meta_title'];
        $model->meta_keywords = $request['meta_keywords'];
        $model->meta_description = $request['meta_description'];
        $model->publish = $request['publish'];

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = Str::slug($request->get('title')) . time() . '.' . $extension;
            $folder = 'uploads/news/';
            $request->file('image')->move($folder, $image);
            $model->image = $folder . $image;
        }

        $model->save();
        $model->categories()->sync($request->get('categories'));

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
        $bredcrumb = $this->title;
        $bredcrumb .= ' / Update';

        $model = News::find($id);
        return view($this->update_form, compact('title', 'bredcrumb', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        // dd($request->all());
        $model = News::find($id);
      
        $model->title = $request['title'];
        $model->description = $request['description'];
        $model->highlited_news = $request['highlited_news'];
        $model->meta_title = $request['meta_title'];
        $model->meta_keywords = $request['meta_keywords'];
        $model->meta_description = $request['meta_description'];
        $model->publish = $request['publish'];

        $folder= 'uploads/news/';
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
        $model->categories()->sync($request->get('categories'));

        return redirect()->back()->with('success', '<span>Record has been Successfully Updated</span>');
    }

    public function postUpdatePublish(Request $request, $publish) 
    {       
        
        $affected_models = News::whereIn('id', $request->get('ids'))->update(array('publish' => $publish));
        return Redirect::back()->with('success', '<div class="success">'.$affected_models.' '.UPDATED.'</div>');        
    }


    public function bulkDelete(Request $request)
    {
        $models = News::whereIn('id', $request->get('ids'))->get();

        foreach ($models as $news) {
            // Detach pivot data
            $news->categories()->detach();

            // Delete image if it exists
            $imagePath = public_path($news->image);
            if ($news->image && File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Now delete the actual news records
        $affected = News::whereIn('id', $request->get('ids'))->delete();

        return redirect()->back()->with('success', $affected . ' ' . DELETED);
    }


    public function destroy($id)
    {
      // dd($id);
        try {
            $model  = News::findOrFail($id);
            $picture = $model->image;
            if ($model->delete()) {
                \File::delete($picture);
                return redirect()->back()->with('success', '<span>Record has been Successfully Deleted</span>');
            }
        } catch (Exception $e) {

        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Http\Requests\AdvertiseRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use BredcrumpHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class AdvertiseController extends Controller
{
    private $title = 'Advertise';
    private $controller = 'admin/advertise';
    private $table = 'advertises';
    private $listing_page = 'admin.advertise.index';
    private $create_form = 'admin.advertise.advertise_add';
    private $update_form = 'admin.advertise.advertise_edit';
    private $publish = array(
    '0'=>'<span class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Inactive</span>', 
    '1'=>'<span class="px-3 py-1 bg-cyan-600 text-white text-xs rounded hover:bg-cyan-600">Active</span>',
    );

    //
    public function index(){
        $title = $this->title. ' Management';
        $bredcrumb = $this->title;
        $publish = $this->publish;

        $models = Advertise::orderBy('position', 'desc')->paginate(10);

        return view($this->listing_page,compact('title','models','bredcrumb','publish','title'));
    }
     public function create()
    {
        $title = $this->title. ' Create';
        $bredcrumb = 'Advertise';
        $bredcrumb .= ' / Create';
        $publish = $this->publish;
        return view($this->create_form, compact('title','bredcrumb', 'publish'));
    }
    // Store the new advertise

    public function store(AdvertiseRequest $request)
    {
        $model = new Advertise();
        $model->title = $request['title'];
        $model->link = $request['link'];
        $model->publish = $request['publish'];

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = Str::slug($request->get('title')) . time() . '.' . $extension;
            $folder = 'uploads/Advertise/';
            $request->file('image')->move($folder, $image);
            $model->image = $folder . $image;
        }

        $model->save();

        
        return redirect()->back()->with('success', '<span>1 ' . CREATED . '</span>');
    }

    public function edit($id)
    {
        $title = $this->title. ' Edit';
        $bredcrumb = $this->title;
        $bredcrumb .= ' / Update';

        $model = Advertise::find($id);
        return view($this->update_form, compact('title','bredcrumb', 'model'));
    }

    public function update(AdvertiseRequest $request, $id)
    {
        // dd($request->all());
        $model = Advertise::find($id);
        $model->title = $request['title'];
        $model->publish = $request['publish'];
        $model->link = $request['link'];

        $folder= 'uploads/advertise/';
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
        
        $affected_models = Advertise::whereIn('id', $request->get('ids'))->update(array('publish' => $publish));
        return Redirect::back()->with('success', '<div class="success">'.$affected_models.' '.UPDATED.'</div>');        
    }


    public function bulkDelete(Request $request)
    {
        $models = Advertise::whereIn('id', $request->get('ids'))->get(array('image'));
        $folder= 'uploads/Advertise/';
        foreach ($models as $m) {
            File::delete(public_path() . $folder, $m->image);
        }
       $affected_models = Advertise::whereIn('id', $request->get('ids'))->delete();

        return redirect()->back()->with('success', $affected_models . ' ' . DELETED);
    }


    public function destroy($id)
    {
      // dd($id);
        try {
            $model  = Advertise::findOrFail($id);
            $picture = $model->image;
            if ($model->delete()) {
                \File::delete($picture);
                return redirect()->back()->with('success', '<span>Record has been Successfully Deleted</span>');
            }
        } catch (Exception $e) {

        }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use BredcrumpHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $controller = 'admin/nav';
    private $title = 'Menu';
    private $table = 'navs';
    private $remember_page = 'nav_parent_id';
    private $listing_page = 'admin.nav.index';
    private $create_form = 'admin.nav.nav_a';
    private $update_form = 'admin.nav.nav_e';
   
    private $publish = array(
    '0'=>'<span class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Inactive</span>', 
    '1'=>'<span class="px-3 py-1 bg-cyan-600 text-white text-xs rounded hover:bg-cyan-600">Active</span>',
    );

    public function index()
    {
        $title = $this->title. ' Management';
        $publish = $this->publish;

        Cache::forget($this->remember_page);

        $breadcrumb = ABS . $this->title;
        $models = Menu::with('submenu')
                ->where('parent_id', 0)
                ->orderBy('position', 'asc')->get();

        return View::make($this->listing_page, compact('title', 'publish', 'breadcrumb', 'models'));
    }

    public function category($id) {
        $title = $this->title;
        $publish = $this->publish;
        //for return page
        Cache::forever($this->remember_page, $id);
        //breadcrumb     
        $breadcrumb = ABS . link_to($this->controller, $this->title);
        $breadcrumb .= ABS . ' / ' .  BredcrumpHelper::admin($this->table, $id, $this->controller . '/sub');

        $models = Menu::with('submenu')
                ->where('parent_id', $id)
                ->orderBy('position', 'asc')
                ->get();
         $parent_id = Cache::get($this->remember_page) ? Cache::get($this->remember_page) : null;
       
        return view($this->listing_page, compact('title', 'publish', 'breadcrumb', 'models', 'parent_id'));
    }
    public function create()
    {
        $title = $this->title. ' Management';
        $parent_id = Cache::get($this->remember_page) ? Cache::get($this->remember_page) : null;

          // breadcrumb
        $breadcrumb = ABS . '<a href="' . url($this->controller) . '">'. e($this->title) . '</a>';
        $breadcrumb .= ABS . ' / Create';
        
    $options = [0 => 'None'] + \TreeHelper::selectOptions(
        'navs',
        $base_id = 0,
        $id = null,
        $terms = null,
        $order_by = 'title',
        $order = 'asc'
    );
        $models = Menu::with('submenu')
                ->where('parent_id', 0)
                ->orderBy('position', 'asc')->get();

        return View::make($this->create_form, compact('title', 'parent_id','breadcrumb','options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Menu($request->all());
        $validator = Validator::make($request->all(), [
            "type" => "required",
            "type_id" => "required_if:type,pages|required_if:type,categories|required_if:type,pcats|required_if:type,blogs|required_if:type,routes",
            "title" => "required_if:type,none|required_if:type,link|required_if:type,routes|required_if:type,other",
            "url" => "required_if:type,routes|required_if:type,link|required_if:type,other",
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if (in_array($request->get('type'), array('pages', 'categories', 'blogs'))) {
            foreach ($request->get('type_id') as $type_id) {
                $model = new Menu($request->all());
                $data = DB::table($request->get('type'))->where('id', $type_id)->take(1)->first(array('slug', 'title'));
                switch ($request->get('type')) {
                        case "pages":
                        $model->url = 'page/' . $data->slug;
                        break;
                        case "categories":
                        $model->url = 'category/' . $data->slug;
                        break;
                        case "blogs":
                        $model->url = 'blog/' .$data->slug;
                        break;
                }
                $model->type_id = $type_id;
    
                $model->save();
            }
        } else {
            $model = new Menu($request->all());
            $model->type_id = 0;
            $model->save();
        }

          if (Cache::get($this->remember_page))
            return Redirect::to($this->controller . '/sub/' . Cache::get($this->remember_page))->with('success', '<span>' . CREATED . '</span>');
        else
            return Redirect::to($this->controller)->with('success', '<span>Record has been Successfully Created</span>');
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

        //breadcrumb
        $breadcrumb = ABS . link_to($this->controller, $this->title);
        $breadcrumb .= ABS . ' / Update';

        $model = Menu::find($id);
        return View::make($this->update_form, compact('title', 'breadcrumb', 'model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $model = Menu::find($id);
       // dd($request->all());
        $model->fill($inputs);
        $validator = Validator::make($request->all(), [
            "type" => "required",
            "type_id" => "required_if:type,pages|required_if:type,categories|required_if:type,pcats|required_if:type,blogs",
            "title" => "required",
            "url" => "required_if:type,routes|required_if:type,other",
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if (in_array($request->get('type'), array('pages', 'categories', 'blogs'))) {
            $data = DB::table($request->get('type'))->where('id', $request->get('type_id'))->take(1)->first(array('slug', 'title'));
            switch ($request->get('type')) {
                case "pages":
                    $model->url = 'page/' . $data->slug;
                    break;
                case "categories":
                    $model->url = 'category/' . $data->slug;
                    break;
                case "blogs":
                    $model->url = 'blog/' .$data->slug;
                    break;
            }
        $model->save();
        } else{   
        $model->fill($inputs);
        $model->type_id = 0;
        $model->save();
        
        }
    
     if (Cache::get($this->remember_page))
            return Redirect::to($this->controller . '/sub/' . Cache::get($this->remember_page))->with('success', '<span>Record has been Successfully Updated</span>');
        return Redirect::to($this->controller)->with('success', '<span>Record has been Successfully Updated</span>');
    }

    public function postUpdatePublish(Request $request, $publish) 
    {         
        $affected_models = Menu::whereIn('id', $request->get('ids'))->update(array('publish' => $publish));
        return Redirect::back()->with('success', '<div class="success">'.$affected_models.' Record has been Successfully Updated</div>');        
    }

    public function bulkDelete(Request $request)
    {
         $models = Menu::whereIn('id', $request->get('ids'))->get(array('id'));
        foreach ($models as $m) {
            $childs = Menu::where('parent_id', $m->id)->count();
            if ($childs > 0)
                Menu::deleteChildModels($m->id);
        }
        Menu::whereIn('id', $request->get('ids'))->delete();

        return redirect()->back()->with('success', '<span>Record has been Successfully Deleted</span>');
    }


    public function destroy($id)
    {
        try {
            $model  = Menu::findOrFail($id);
            if ($model->delete()) {
                $childs = Menu::where('parent_id', $id)->count();
                if ($childs > 0)
                    Menu::deleteChildModels($id);

                return redirect()->back()->with('success', '<span>Record has been Successfully Deleted</span>');
            }
        } catch (Exception $e) {

        }
    }
    public function changeTypeCreate(Request $request) {
        $type = $request->get('type');
        return View::make('admin.nav.nav_type_partial_a', compact('type'));
    }

    public function changeTypeUpdate(Request $request) {
        $type = $request->get('type');
        return View::make('admin.nav.nav_type_partial_e', compact('type'));
    }

    public function postSearchByTitleCreate(Request $request) {
        $type = $request->get('type');
        $search_txt = $request->get('search_txt');

        $models = \DB::table($type)->where(function($query) use ($search_txt) {
                    $terms = explode('-', $search_txt);
                    foreach ($terms as $t) {
                        $query->where('title', 'LIKE', '%' . $t . '%');
                    }
                })->take(10)->pluck('title', 'id');

        return \Form::select('type_id[]', $models, null, array('class' => 'fsl_half set_height'));
    }

    public function postSearchByTitleUpdate(Request $request) {
        $type = $request->get('type');
        $search_txt = $request->get('search_txt');
        $models = DB::table($type)->where(function($query) use ($search_txt) {
                    $terms = explode('-', $search_txt);
                    foreach ($terms as $t) {
                        $query->where('title', 'LIKE', '%' . $t . '%');
                    }
                })->take(10)->pluck('title', 'id');
        return \Form::select('type_id', $models, null, array('class' => 'fsl_half'));
    }
}

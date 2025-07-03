<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Models\Point;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use BredcrumpHelper;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Auth;
class AdminController extends Controller
{
    private $title = 'Admin';
    private $controller = 'admin/admin';
    private $table = 'users';
    private $listing_page = 'admin.admin.index';
    private $create_form = 'admin.admin.admin_add';
    private $update_form = 'admin.admin.admin_edit';
    private $listing_profile = 'admin.admin.profile';

    private $publish = array(
    '0'=>'<span class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600">Inactive</span>', 
    '1'=>'<span class="px-3 py-1 bg-cyan-600 text-white text-xs rounded hover:bg-cyan-600">Active</span>',
    );

    public function index()
    {
        $title = $this->title. ' Management';
        $publish = $this->publish;
        $breadcrumb = ABS . $this->title;
        $models = User::where('user_type', 1)->orderBy('id', 'desc')->get();

        return view($this->listing_page, compact('title', 'models', 'breadcrumb', 'publish', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $title = $this->title . ' Create';
        $breadcrumb = $this->title;
        $breadcrumb .= ABS . ' / Create';
        $publish = $this->publish;
        $roles = Role::pluck('name','name')->all();
        return view($this->create_form, compact('title', 'breadcrumb', 'publish', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
         // dd($request->all()); //dump and die
        $model = new User();
       
        $model->name = $request['name'];
        $model->email = $request['email'];
        $model->phone = $request['phone'];
        $model->detail = $request['detail'];
        $model->password = Hash::make($request['password']);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = Str::slug($request->get('name')) . time() . '.' . $extension;
            $folder= 'uploads/user/';
            $request->file('image')->move($folder, $image);
            
        $model->image = $folder.$image;
        }
        // dd($request->get('roles'));
        $model->user_type = 1;
        $model->publish = $request['publish'];
        $model->remember_token = $request->get('_token');
        $model->assignRole($request->get('roles'));
        $model->save();

            return redirect()->back()->with('success', '<span>Record has been Successfully Created</span>');
    }

    public function getProfile($id)
    {
        $title = $this->title . ' Profile';
        $publish = $this->publish;
        $breadcrumb = $this->title;
        $breadcrumb .= ABS . ' / Profile';

        $model = Auth::user()->where('id', $id)
                ->firstOrFail();
        $models = User::orderBy('id', 'desc')->get();
        $roles = Role::pluck('name','name')->all();
        $userRole = $model->roles->pluck('name','name')->all();
        return view($this->listing_profile, compact('title','publish', 'breadcrumb', 'model', 'models', 'roles', 'userRole'));
    }


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
        $breadcrumb .= ABS . ' / Update';

        $model = User::where('id', $id)
                ->firstOrFail();
        $roles = Role::with('roles')->pluck('name','name')->all();
        $userRole = $model->roles->pluck('name','name')->all();
        // dd($userRole);
        return view($this->update_form, compact('title', 'breadcrumb', 'model', 'roles', 'userRole'));
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
        // dd($request->all());
        $model = User::find($id);

        $model->name = $request['name'];
        $model->phone = $request['phone'];
        $model->detail = $request['detail'];
        $model->user_type =1;
        $folder= 'uploads/user/';
         if ($request->hasFile('image')) {
            if($model->image){
         \File::delete(public_path() . $folder, $model->image);  
        }
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = Str::slug($request->get('name')) . time() . '.' . $extension;
            $request->file('image')->move($folder, $image);
            
           $model->image = $folder.$image;
        } else if ($request->get('delete_image')) {
            if ($model->image) {
             \File::delete(public_path() . $folder, $model->image);
            }
            $model->image = '';
        }
        $model->publish = $request['publish'];
        $model->email = Str::lower($request->get('email'));
         \DB::table('model_has_roles')->where('model_id',$id)->delete();
        
        if(!empty($request->get('roles'))){
            $model->assignRole($request->get('roles'));
        }
        else if (!empty($request->get('user_role'))){
            $model->assignRole($request->get('user_role'));
        }
        $model->save();
        return redirect()->back()->with('success', '<span>Record has been Successfully Updated</span>');
    }

    public function postUpdatePublish(Request $request, $publish) 
    {       
        // dd($request->all());
        $affected_models = User::whereIn('id', $request->get('ids'))->update(array('publish' => $publish));
        return Redirect::back()->with('success', '<div class="success">'.$affected_models.' '.UPDATED.'</div>');        
    }
        

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Your Password Changed Successfully');
        } else {
            return redirect()->back()->with('error', "Old Password didn't match our database");
        }
    }

    public function destroy($id)
    {
        try {
            $model  = User::findOrFail($id);
             $picture = $model->image;
            if ($model->delete()) {
                 \File::delete($picture);
                return redirect()->back()->with('success', '<span>Record has been Successfully Deleted</span>');
            }
        } catch (Exception $e) {

        }
    }
}

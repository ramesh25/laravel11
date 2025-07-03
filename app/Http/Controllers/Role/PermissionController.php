<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionController extends Controller
{
    private $title = 'Permission';
    private $controller = 'admin/permission';
    private $table = 'permissions';
    
    public function index(Request $request)
    {
        $models = Permission::orderBy('id','DESC')->get();
         $title = $this->title. ' Management';
        $breadcrumb = ABS . $this->title;
        return view('admin.role.permission_index',compact('models','title', 'breadcrumb'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = $this->title. ' Create';
        $breadcrumb = $this->title;
        $breadcrumb .= ABS . ' / Create';
        return view('admin.role.permission_create',compact('title', 'breadcrumb'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $permission = new Permission($request->all());

        $permission->guard_name = 'web';
        $permission->save();

        return redirect()->back()->with('success','Record has been created successfully');
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
        $model = Permission::find($id);
        
        $title = $this->title. ' Edit';
        $breadcrumb = $this->title;
        $breadcrumb .= ABS . ' / Update';

        return view('admin.role.permission_edit',compact('model', 'title', 'breadcrumb'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        // dd($request->all());
        $permission = Permission::find($id);
        
        $permission->name = $request['name'];
        
        $permission->save();

        return redirect()->back()->with('success','Record has been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

     DB::table("permissions")->where('id',$id)->delete();

        return redirect()->back()->with('success','Record has been deleted successfully');
    }
}
<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\RoleRequest;
use DB;


class RoleController extends Controller
{
    private $title = 'Roles';
    private $controller = 'admin/roles';
    private $table = 'roles';

    
    public function index(Request $request)
    {
        $models = Role::orderBy('id','DESC')->get();
         $title = $this->title. ' Management';
        $breadcrumb = ABS . $this->title;
        return view('admin.role.role_index',compact('models','title', 'breadcrumb'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        $title = $this->title. ' Create';
        $breadcrumb = $this->title;
        $breadcrumb .= ABS . ' / Create';
        return view('admin.role.role_create',compact('permission', 'title', 'breadcrumb'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
       
        $role = Role::create(['name' => $request->input('name'), 'guard_name' => 'web']);
        $role->syncPermissions($request->input('permission'));


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
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();

        $title = $this->title. ' Detail';
        $breadcrumb = ABS . $this->title;
        return view('admin.role.role_show',compact('role','rolePermissions', 'title', 'breadcrumb'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $title = $this->title. ' Edit';
        $breadcrumb = $this->title;
        $breadcrumb .= ABS . ' / Update';

        return view('admin.role.role_edit',compact('model','permission','rolePermissions', 'title', 'breadcrumb'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->guard_name = 'web';
        $role->save();

        // This handles when no checkbox is selected
        $role->syncPermissions($request->input('permission') ?? []);

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

     DB::table("roles")->where('id',$id)->delete();

        return redirect()->back()->with('success','Record has been deleted successfully');
    }
}
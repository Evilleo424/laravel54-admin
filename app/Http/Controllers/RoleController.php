<?php
namespace App\Http\Controllers;
use App\AdminPermission;
use App\AdminRole;
use Illuminate\Http\Request;
class RoleController extends Controller
{
    public function index(){
        $roles = AdminRole::paginate(10);
        return view('role.index',compact('roles'));
    }
    public function create(){
        return view('role.create');
    }
    public function store(){
        $this->validate(request(),[
            'name'          => 'required|string|min:2',
            'description'   => 'required|min:5'
        ]);
        AdminRole::create(request(['name','description']));
        return redirect('/roles');
    }
    public function edit(AdminRole $role){
        return view('role.edit',compact('role'));
    }
    public function update(AdminRole $role){
        $this->validate(request(),[
            'name'          => 'required|string|min:2',
            'description'   => 'required|min:5'
        ]);
        $role->name = request('name');
        $role->description = request('description');
        $role->save();
        return  redirect('/roles');
    }
    public function permission(AdminRole $role){
        $permissions = AdminPermission::all();
        $myPermissions = $role->permissions;
        return view('role.permission',compact('permissions','myPermissions','role'));
    }
    public function storePermission(AdminRole $role){
        $this->validate(request(),[
            'permissions' => 'nullable|array'
        ]);
        $permissions = AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;
        $addPermissions = $permissions->diff($myPermissions);
        foreach($addPermissions as $permission){
            $role->grantPermission($permission);
        }
        $delPermissions = $myPermissions->diff($permissions);
        foreach($delPermissions as $permission){
            $role->deletePermission($permission);
        }
        return back();
    }

    public function destroy(AdminRole $role){
        $role->delete();
        return [
            'error' => 0,
            'msg'   => ''
        ];
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminPermissionController extends Controller
{
    //
    public function showPermissionList(){
        $permissions = Permission::with('roles')->paginate(10);
        return view('admin.permission.list',compact('permissions'));
    }

    public function removeRole(Request $request){
        $this->authorize('manage', User::class);

        $permission = Permission::findOrFail($request->permissionId);
        $role = Role::findOrFail($request->roleId);

        $permission->removeRole($role);

        //渲染
        $status = 1;
        $msg = "The role has been removed";
        return json_encode(compact('status','msg'));//ajax

    }

    public function showCreatPermission(){
        $roles = Role::all();
        return view('admin.permission.create',compact('roles'));
    }

    public function store(Request $request){
        $this->authorize('manage', User::class);

        $this->validate($request,[
           'name'=>'required'
        ]);

        $permission = Permission::create(['name' => $request->name]);
        if (!empty($request->role_id)){
            foreach ($request->role_id as $role_id){
                $role = Role::findOrFail($role_id);
                $permission ->assignRole($role);
            }
        }
        return \redirect()->back()->with('tips', ['权限创建成功',]);

    }

    public function showEditPermission(Permission $permission){
        $roles = Role::all();
        return view('admin.permission.edit',compact('roles','permission'));
    }

    public function update(Permission $permission,Request $request){
        $this->authorize('manage', User::class);

        $this->validate($request,[
           'name'=>'required'
        ]);

        $permission->update(['name' => $request->name]);
        if (!empty($request->role_id)){
            $permission ->syncRoles($request->role_id);
        }
        return \redirect()->back()->with('tips', ['权限编辑成功',]);

    }

    public function delete(Request $request){
        $this->authorize('manage', User::class);

        Permission::findOrFail($request->id)->delete();

        $status = 1;
        $msg = "The permission has been deleted";
        return json_encode(compact('status','msg'));//ajax
    }
}

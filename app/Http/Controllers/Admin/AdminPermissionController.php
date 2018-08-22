<?php

namespace App\Http\Controllers\Admin;

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
        $permission = Permission::findOrFail($request->permissionId);
        $role = Role::findOrFail($request->roleId);

        $permission->removeRole($role);

        //渲染
        $status = 1;
        $msg = "The role has been removed";
        return json_encode(compact('status','msg'));//ajax

    }

    public function showCreatPermission(){
        return view('admin.permission.create');
    }
}

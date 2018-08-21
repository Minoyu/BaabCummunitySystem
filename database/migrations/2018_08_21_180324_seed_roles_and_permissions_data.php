<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    public function up()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 先创建权限
        //管理权限
        Permission::create(['name' => 'manage_contents']);
        Permission::create(['name' => 'manage_users']);
        Permission::create(['name' => 'edit_settings']);
        //用户权限
        //用户能否操作(禁言)
        Permission::create(['name' => 'do_action']);

        // 创建站长角色，并赋予权限
        $founder = Role::create(['name' => 'Founder']);
        $founder->givePermissionTo('manage_contents');
        $founder->givePermissionTo('manage_users');
        $founder->givePermissionTo('edit_settings');
        $founder->givePermissionTo('do_action');

        // 创建管理员角色，并赋予权限
        $maintainer = Role::create(['name' => 'Maintainer']);
        $maintainer->givePermissionTo('manage_contents');
        $maintainer->givePermissionTo('do_action');

        // 创建普通用户角色，并赋予权限
        $normalUser = Role::create(['name' => 'NormalUser']);
        $normalUser->givePermissionTo('manage_contents');
        $normalUser->givePermissionTo('do_action');

        // 创建禁言用户角色，并赋予权限
        $banedUser = Role::create(['name' => 'BanedUser']);

    }

    public function down()
    {
        // 清除缓存
        app()['cache']->forget('spatie.permission.cache');

        // 清空所有数据表数据
        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}

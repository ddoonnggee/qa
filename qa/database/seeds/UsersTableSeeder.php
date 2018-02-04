<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionGroup;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('permission_role')->truncate();
        DB::table('role_user')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('permission_groups')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $faker = Faker\Factory::create();

        //User
        $admin = User::create([
            'email' => 'admin@admin.com',
            'name' => '管理员',
            'password' => bcrypt('adminadmin')
        ]);

        $test_user = User::create([
            'email' => 'test@test.com',
            'name' => '测试用户',
            'password' => bcrypt('testtest')
        ]);

        //Roles
        $role_admin = Role::create(['name' => 'admin', 'display_name' => '管理员']);
        $role_editor = Role::create(['name' => 'editor', 'display_name' => '编辑']);
        $role_user = Role::create(['name' => 'user', 'display_name' => '普通用户']);

        //Permission&PermissionGroup
        PermissionGroup::create(['name' => '后台']);
        PermissionGroup::create(['name' => 'RBAC','parent_id' => 1]);
        Permission::create(['name' => 'dashboard_view', 'display_name' => '首页', 'group_id' => 1]);

        $models = [
            ['route_name' => 'users','menu_name' => '帐户','group_id' =>3,'group_pid' =>2],
            ['route_name' => 'roles','menu_name' => '角色','group_id' =>4,'group_pid' =>2],
            ['route_name' => 'permissions','menu_name' => '权限','group_id' =>5,'group_pid' =>2],
            ['route_name' => 'permissiongroups','menu_name' => '权限分组','group_id' =>6,'group_pid' =>2],
            ['route_name' => 'articles','menu_name' => '文章','group_id' =>7,'group_pid' =>1],
            ['route_name' => 'settings','menu_name' => '配置','group_id' =>8,'group_pid' =>1],
        ];

        foreach ($models as $key=>$model) {
            PermissionGroup::create(['name' => $model['menu_name'],'parent_id' => $model['group_pid']]);
            Permission::create(['group_id' => $model['group_id'],'name' => $model['route_name'].'_view', 'display_name' => $model['menu_name'].'菜单']);
            Permission::create(['group_id' => $model['group_id'],'name' => $model['route_name'].'_create', 'display_name' => '新建'.$model['menu_name']]);
            Permission::create(['group_id' => $model['group_id'],'name' => $model['route_name'].'_update', 'display_name' => '修改'.$model['menu_name']]);
            Permission::create(['group_id' => $model['group_id'],'name' => $model['route_name'].'_delete', 'display_name' => '删除'.$model['menu_name']]);

        }

        //Roles Users
        $test_user->roles()->save($role_editor);

        //Roles Users
        // $role_admin->givePermissionTo($permission_admin_user);
    }
}

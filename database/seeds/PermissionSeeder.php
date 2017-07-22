<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    private $admin;
    private $test;
    private $role;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sidebar = $this->sidebar();
        $this->user();
        $this->role();
		$this->user_role();
        $this->permission_seed($sidebar);
    }

    private function role()
    {
        \App\AdminRole::insert([
            'name'          => '超级管理员',
            'description'   => '最高权限管理员'
        ]);
        $this->role = \App\adminRole::create(array(
            'name'          => '测试员',
            'description'   => '测试模块'
        ));
    }

	private function user_role(){
		$role = \App\AdminRole::find(1);
		$this->admin->assignRole($role);
	}

    private function user()
    {
        $this->admin = \App\User::create(array(
            'name'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('123456')
        ));
        $this->test = \App\User::create(array(
            'name'      => 'test',
            'email'     => 'test@test.com',
            'password'  => bcrypt('123456')
        ));

    }


    private function permission_seed($left_bar, $parent_id = 0)
    {
        foreach ($left_bar as $val) {
            $model = \App\AdminPermission::create(array(
                'id'            => $val['id'],
                'name'          => $val['name'],
                'parent_id'     => $val['parent_id'],
                'action'        => $val['action'],
                'namespace'     => $val['namespace'],
                'controller'    => $val['controller'],
                'class'         => $val['class'],
                'description'   => $val['description'],

            ));
            if (isset($val['children']) && $val['children']) {
                $this->permission_seed($val['children'], $model->id);
            }
            /*if ($val['action_class'] == 'Test1Controller' || $val['action_name'] == '测试模块1') {
                $this->role1->actions()->save($model);
            }
            if ($val['action_class'] == 'Test2Controller' || $val['action_name'] == '测试模块2') {
                $this->role2->actions()->save($model);
            }
            if ($val['action_class'] == 'HomeController') {
                $this->role1->actions()->save($model);
                $this->role2->actions()->save($model);
            }*/
        }
    }

    private function sidebar()
    {
        return array(
            0 =>
                array(
                    'id' => 1,
                    'name' => '欢迎',
                    'description' => '',
                    'parent_id' => 0,
                    'class' => 'fa-dashboard',
                    'namespace' => 'App\\Http\\Controllers',
                    'controller' => 'HomeController',
                    'action' => 'index',
                    'children' =>
                        array(),
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => '权限管理',
                    'description' => '',
                    'parent_id' => 0,
                    'class' => 'fa-gears',
                    'namespace' => '',
                    'controller' => '',
                    'action' => '',
                    'children' =>
                        array(),
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => '用户管理',
                    'description' => '',
                    'parent_id' => 2,
                    'class' => 'fa-users',
                    'namespace' => 'App\\Http\\Controllers',
                    'controller' => 'UserController',
                    'action' => 'index',
                    'children' =>
                        array(
                            0 =>
                                array(
                                    'id' => 10,
                                    'name' => '添加用户',
                                    'description' => '',
                                    'parent_id' => 3,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'UserController',
                                    'action' => 'create',
                                ),
                            1 =>
                                array(
                                    'id' => 11,
                                    'name' => '保存用户',
                                    'description' => '',
                                    'parent_id' => 3,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'UserController',
                                    'action' => 'store',
                                ),
                            2 =>
                                array(
                                    'id' => 12,
                                    'name' => '编辑用户',
                                    'description' => '',
                                    'parent_id' => 3,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'UserController',
                                    'action' => 'edit',
                                ),
                            3 =>
                                array(
                                    'id' => 13,
                                    'name' => '更新用户',
                                    'description' => '',
                                    'parent_id' => 3,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'UserController',
                                    'action' => 'update',
                                ),
	                        4 =>
		                        array(
			                        'id' => 18,
			                        'name' => '删除用户',
			                        'description' => '',
			                        'parent_id' => 3,
			                        'class' => NULL,
			                        'namespace' => 'App\\Http\\Controllers',
			                        'controller' => 'UserController',
			                        'action' => 'destroy',
		                        ),
                        ),
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => '角色管理',
                    'description' => '',
                    'parent_id' => 2,
                    'class' => 'fa-user-plus',
                    'namespace' => 'App\\Http\\Controllers',
                    'controller' => 'RoleController',
                    'action' => 'index',
                    'children' =>
                        array(
                            0 =>
                                array(
                                    'id' => 14,
                                    'name' => '添加角色',
                                    'description' => '',
                                    'parent_id' => 4,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'RoleController',
                                    'action' => 'create',
                                ),
                            1 =>
                                array(
                                    'id' => 16,
                                    'name' => '编辑角色',
                                    'description' => '',
                                    'parent_id' => 4,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'RoleController',
                                    'action' => 'edit',
                                ),
                            2 =>
                                array(
                                    'id' => 17,
                                    'name' => '更新角色',
                                    'description' => '',
                                    'parent_id' => 4,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'RoleController',
                                    'action' => 'update',
                                ),
                            3 =>
                                array(
                                    'id' => 15,
                                    'name' => '保存角色',
                                    'description' => '',
                                    'parent_id' => 4,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'RoleController',
                                    'action' => 'store',
                                ),
	                        4 =>
		                        array(
			                        'id' => 19,
			                        'name' => '删除角色',
			                        'description' => '',
			                        'parent_id' => 4,
			                        'class' => NULL,
			                        'namespace' => 'App\\Http\\Controllers',
			                        'controller' => 'RoleController',
			                        'action' => 'destroy',
		                        ),
                        ),
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => '操作管理',
                    'description' => '',
                    'parent_id' => 2,
                    'class' => 'fa-cogs',
                    'namespace' => 'App\\Http\\Controllers',
                    'controller' => 'PermissionController',
                    'action' => 'index',
                    'children' =>
                        array(
                            0 =>
                                array(
                                    'id' => 6,
                                    'name' => '添加操作',
                                    'description' => '',
                                    'parent_id' => 5,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'PermissionController',
                                    'action' => 'create',
                                ),
                            1 =>
                                array(
                                    'id' => 7,
                                    'name' => '保存操作',
                                    'description' => '',
                                    'parent_id' => 5,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'PermissionController',
                                    'action' => 'store',
                                ),
                            2 =>
                                array(
                                    'id' => 8,
                                    'name' => '编辑操作',
                                    'description' => '',
                                    'parent_id' => 5,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'PermissionController',
                                    'action' => 'edit',
                                ),
                            3 =>
                                array(
                                    'id' => 9,
                                    'name' => '更新操作',
                                    'description' => '',
                                    'parent_id' => 5,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers',
                                    'controller' => 'PermissionController',
                                    'action' => 'update',
                                ),
	                        4 =>
		                        array(
			                        'id' => 20,
			                        'name' => '删除操作',
			                        'description' => '',
			                        'parent_id' => 5,
			                        'class' => NULL,
			                        'namespace' => 'App\\Http\\Controllers',
			                        'controller' => 'PermissionController',
			                        'action' => 'destroy',
		                        ),
                        ),
                ),
        );
    }
}

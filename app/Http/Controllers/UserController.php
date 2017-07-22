<?php

namespace App\Http\Controllers;

use App\AdminPermission;
use App\AdminRole;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
	    $users = User::paginate(10);
	    return view('user.index',compact('users'));
    }

	public function create(){
		return view('user.create');
	}

	public function store(){
		$this->validate(request(),[
			'name'      => 'required|string|min:3|max:10',
			'password'  => 'required|min:5|max:10',
			'email'     => 'required|email'
		]);

		$name = request('name');
		$password = bcrypt(request('password'));
		$email = request('email');
		User::create(compact('name','password','email'));
		return redirect('/users');
	}

	public function edit(User $user){
		return view('user.edit',compact('user'));
	}

	public function update(User $user){
		$this->validate(request(),[
			'name'      => 'string|min:3|max:10',
			'email'     => 'email'
		]);
		$user->name     = request('name');
		$user->email    = request('email');
		if(request('password')){
			$this->validate(request(),[
				'password'  => 'min:5|max:10'
			]);
			$user->password = bcrypt(request('password'));
		}

		$user->save();
		return redirect('/users');

	}

	public function role(User $user){
		$roles = AdminRole::all();
		$myRoles = $user->roles;
		return view('user.role',compact('user','roles','myRoles'));
	}

	public function storeRole(User $user){
		$this->validate(request(),[
			'roles' =>'array'
		]);
		$roles = AdminRole::findMany(request('roles'));
		$myRoles = $user->roles;

		//要增加的角色
		$addRoles = $roles->diff($myRoles);
		foreach($addRoles as $role){
			$user->assignRole($role);
		}

		//要删除的
		$deleteRoles = $myRoles->diff($roles);
		foreach($deleteRoles as $role){
			$user->deleteRole($role);
		}
		return back();
	}


    public function destroy(User $user){
	    $roles = $user->roles;
	    foreach($roles as $role){
		    $user->deleteRole($role);
	    }
        $user->delete();
        return [
            'error' => 0,
            'msg'   => ''
        ];
    }
}

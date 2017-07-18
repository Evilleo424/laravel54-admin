<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = [];

    public function roles(){
        return $this->belongsToMany(AdminRole::class,'admin_user_role','user_id','role_id')->withPivot(['user_id', 'role_id']);
    }


    //判断是否有某个角色
    public function isInRoles($roles){
        return !!$roles->intersect($this->roles)->count();
    }

    //给用户分配角色
    public function assignRole($role){
        return $this->roles()->save($role);
    }


    //取消用户的角色
    public function deleteRole($role){
        return $this->roles()->detach($role);
    }


    //用户是否有权限
    public function hasPermission($permission){
        return $this->isInRoles($permission->roles);
    }

}

<?php

namespace App\Model;

use App\Base\Model;
use App\Traits\HasPermissionsTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserModel
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Model
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class UserModel extends Model
{

    use HasPermissionsTrait,
        SoftDeletes;

    protected $table = 'users';
    protected $dates = ['deleted_at'];

    public function can(string $action)
    {
        if (!$permission = PermissionModel::where('name', $action)->first()) {
            return false;
        }
        return $this->hasPermissionTo($permission);
    }

    public function is($action)
    {
        if (!$role = RoleModel::where('name', $action)->first()) {
            return false;
        }
        return $this->hasRole($role);
    }

    public function isAdmin()
    {
        return $this->is('Admin');
    }

    public function isSuperAdmin()
    {
        return $this->is('Super Admin');
    }

    public function permissions()
    {
        return $this->belongsToMany(PermissionModel::class, 'users_permissions', 'user_id', 'permission_id');
    }

    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'users_roles', 'user_id', 'role_id');
    }

}

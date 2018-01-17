<?php

namespace App\Model;

use App\Base\Model;
use App\Traits\HasPermissionsTrait;

/**
 * Class UserModel
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Model
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class UserModel extends Model
{

    use HasPermissionsTrait;

    protected $table = 'users';

    public function can(string $action)
    {
        if (!$permission = PermissionModel::where('name', $action)->first()) {
            return false;
        }
        return $this->hasPermissionTo($permission);
    }

    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('Super Admin');
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

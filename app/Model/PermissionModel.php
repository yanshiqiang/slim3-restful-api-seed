<?php

namespace App\Model;

use App\Base\Model;

/**
 * Class PermissionModel
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Model
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class PermissionModel extends Model
{

    protected $table = 'permissions';

    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'roles_permissions', 'permission_id', 'role_id');
    }

}

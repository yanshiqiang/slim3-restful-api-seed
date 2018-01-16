<?php

namespace App\Model;

use App\Base\Model;

/**
 * Class RoleModel
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Model
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class RoleModel extends Model
{

    protected $table = 'roles';

    public function permissions()
    {
        return $this->belongsToMany(PermissionModel::class, 'roles_permissions', 'role_id', 'permission_id');
    }

}

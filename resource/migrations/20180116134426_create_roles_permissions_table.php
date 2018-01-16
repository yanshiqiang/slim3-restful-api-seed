<?php

use App\Base\Migration;
use App\Model\RoleModel;
use App\Model\PermissionModel;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateRolesPermissionsTable
 *
 * @author John Doe <john.doe@example.com>
 * @category Migration
 * @see https://example.com
 */
class CreateRolesPermissionsTable extends Migration
{

    public function up()
    {
        $this->schema()->create('roles_permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('permission_id')->references('id')->on('permissions');
        });
        
        $admin = RoleModel::find(1);
        $admin->permissions()->saveMany([
            PermissionModel::find(1),
            PermissionModel::find(2),
            PermissionModel::find(5),
        ]);

        $superAdmin = RoleModel::find(2);
        $superAdmin->permissions()->saveMany([
            PermissionModel::find(1),
            PermissionModel::find(2),
            PermissionModel::find(3),
            PermissionModel::find(4),
            PermissionModel::find(5),
            PermissionModel::find(6),
        ]);
    }

    public function down()
    {
        $this->schema()->drop('roles_permissions');
    }

}

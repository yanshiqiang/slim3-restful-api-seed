<?php

use App\Base\Migration;
use App\Model\PermissionModel;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreatePermissionsTable
 *
 * @author John Doe <john.doe@example.com>
 * @category Migration
 * @see https://example.com
 */
class CreatePermissionsTable extends Migration
{

    public function up()
    {
        $this->schema()->create('permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->string('name', 255);
            $table->timestamps();
        });

        $dateTime = (new \DateTime())->format('Y-m-d H:i:s');

        PermissionModel::insert([
            ['name' => 'Delete Users', 'description' => '', 'created_at' => $dateTime, 'updated_at' => $dateTime],
            ['name' => 'Manage Roles', 'description' => '', 'created_at' => $dateTime, 'updated_at' => $dateTime],
            ['name' => 'Edit Users', 'description' => '', 'created_at' => $dateTime, 'updated_at' => $dateTime],
            ['name' => 'Edit Admins', 'description' => '', 'created_at' => $dateTime, 'updated_at' => $dateTime],
            ['name' => 'View Admin Pages', 'description' => '', 'created_at' => $dateTime, 'updated_at' => $dateTime],
            ['name' => 'Make Admin', 'description' => '', 'created_at' => $dateTime, 'updated_at' => $dateTime]
        ]);
    }

    public function down()
    {
        $this->schema()->drop('permissions');
    }

}

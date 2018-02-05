<?php

use App\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateUsersPermissionsTable
 *
 * @author John Doe <john.doe@example.com>
 * @category Migration
 * @see https://example.com
 */
class CreateUsersPermissionsTable extends Migration
{

    public function up()
    {
        $this->schema()->create('users_permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        $this->schema()->drop('users_permissions');
    }

}

<?php

use App\Base\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateUsersRolesTable
 *
 * @author John Doe <john.doe@example.com>
 * @category Migration
 * @see https://example.com
 */
class CreateUsersRolesTable extends Migration
{

    public function up()
    {
        $this->schema()->create('users_roles', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        $this->schema()->drop('users_roles');
    }

}

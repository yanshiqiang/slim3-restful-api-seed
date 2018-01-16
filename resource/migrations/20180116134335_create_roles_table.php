<?php

use App\Base\Migration;
use App\Model\RoleModel;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateRolesTable
 *
 * @author John Doe <john.doe@example.com>
 * @category Migration
 * @see https://example.com
 */
class CreateRolesTable extends Migration
{

    public function up()
    {
        $this->schema()->create('roles', function(Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->string('name', 255);
            $table->timestamps();
        });
        
        $dateTime = (new \DateTime())->format('Y-m-d H:i:s');
        
        RoleModel::insert([
            ['name' => 'Admin', 'description' => '', 'created_at' => $dateTime, 'updated_at' => $dateTime],
            ['name' => 'Super Admin', 'description' => '', 'created_at' => $dateTime, 'updated_at' => $dateTime]
        ]);
    }

    public function down()
    {
        $this->schema()->drop('roles');
    }

}

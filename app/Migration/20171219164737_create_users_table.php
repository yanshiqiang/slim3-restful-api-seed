<?php

use App\Migration\Migration;
use App\Model\UserModel;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateUsersTable Migration
 * 
 * @category Migration
 *
 * @author John Doe <john.doe@example.com>
 * @see https://example.com
 */
class CreateUsersTable extends Migration
{

    public function up()
    {
        $this->schema()->create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('biography', 254)->nullable();
            $table->string('email', 254);
            $table->string('forename', 100);
            $table->string('location', 100)->nullable();
            $table->text('password');
            $table->text('salt');
            $table->string('surname', 100);
            $table->string('username', 32);
            $table->string('website', 100)->nullable();
            $table->softDeletes();	
            $table->timestamps();
        });
        UserModel::insert([
            ['email' => 'admin@mail.com', 'forename' => 'Andrew', 'surname' => 'Dyer', 'username' => 'admin', 'password' => 'ea2959d87ea2974afcd45c6224d2e5322bc349db8e65f8a3c7460e2a8fb9a883', 'salt' => '>TrKAx^/<E^+aX!-5K|}pL!Po9(gH_Fr']
        ]);
    }

    public function down()
    {
        $this->schema()->drop('users');
    }

}

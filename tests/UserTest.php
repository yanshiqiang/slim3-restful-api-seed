<?php

use App\Model\UserModel;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testCanDeleteUsers()
    {
        $user = UserModel::find(1);

        $this->assertEquals($user->can('Delete Users'), true);
    }

    public function testIsAdmin()
    {
        $user = UserModel::find(1);

        $this->assertEquals($user->isAdmin(), true);
    }

    public function testIsSuperAdmin()
    {
        $user = UserModel::find(1);

        $this->assertEquals($user->isSuperAdmin(), true);
    }

}

<?php

namespace App\Base;

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class Migration
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Base
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class Migration extends AbstractMigration
{

    private $_schema;

    public function init()
    {
        $this->_schema = (new Capsule)->schema();
    }

    public function schema()
    {
        return $this->_schema;
    }

}

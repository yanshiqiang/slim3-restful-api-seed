<?php

namespace App\Base;

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class Migration
 * 
 * @author Andrew Dyer
 * @category Base
 * @see https://example.com
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

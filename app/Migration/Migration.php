<?php

namespace App\Migration;

use Phinx\Migration\AbstractMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class Migration
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Migration
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class Migration extends AbstractMigration
{

    /** @var Illuminate\Database\Schema\MySqlBuilder */
    private $_schema;

    /**
     * 
     */
    public function init()
    {
        $this->_schema = (new Capsule)->schema();
    }

    /**
     * 
     * @return Illuminate\Database\Schema\MySqlBuilder
     */
    public function schema()
    {
        return $this->_schema;
    }

}

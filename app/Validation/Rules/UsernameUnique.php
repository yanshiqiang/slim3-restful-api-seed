<?php

namespace App\Validation\Rules;

use App\Model\UserModel;
use Respect\Validation\Rules\AbstractRule;

/**
 * Class UsernameUnique
 * 
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Validation
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
class UsernameUnique extends AbstractRule
{

    private $_username;

    public function __construct($username = '')
    {
        $this->_username = $username;
    }

    public function validate($input)
    {
        if ($this->_username and $this->_username === $input) {
            return true;
        }
        return(UserModel::where('username', $input)->count() === 0);
    }

}

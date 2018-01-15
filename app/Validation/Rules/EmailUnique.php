<?php

namespace App\Validation\Rules;

use App\Model\UserModel;
use Respect\Validation\Rules\AbstractRule;

/**
 * Class EmailUnique
 * 
 * @author Andrew Dyer
 * @category Validation
 * @see https://example.com
 */
class EmailUnique extends AbstractRule
{

    private $_email;

    public function __construct($email = '')
    {
        $this->_email = $email;
    }

    public function validate($input)
    {
        if ($this->_email and $this->_email === $input) {
            return true;
        }
        return(UserModel::where('email', $input)->count() === 0);
    }

}

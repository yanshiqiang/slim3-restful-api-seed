<?php

namespace App\Validation;

use Slim\Http\Request;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 * Class Validator
 * 
 * @author Andrew Dyer
 * @category Validation
 * @see https://example.com
 */
class Validator
{

    private $_errors = [];

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return empty($this->_errors);
    }

    public function validate(Request $request, array $rules)
    {
        foreach ($rules as $key => $validator) {
            try {
                $name = str_replace(['-', '_'], ' ', ucfirst(strtolower($key)));
                $validator->setName($name)->assert($request->getParam($key));
            } catch (NestedValidationException $ex) {
                $this->_errors[$key] = $ex->getMessages();
            }
        }

        return $this;
    }

}

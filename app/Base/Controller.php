<?php

namespace App\Base;

use App\Interfaces\ContainerAwareInterface;
use App\Traits\ContainerAwareTrait;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Controller
 * 
 * @author Andrew Dyer
 * @category Base
 * @see https://example.com
 */
abstract class Controller implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    private $_request, $_response;

    /**
     * 
     * @param ContainerInterface $container
     * @param Request $request
     * @param Response $response
     */
    public function __construct(ContainerInterface $container, Request $request, Response $response)
    {
        $this->_request = $request;
        $this->_response = $response;
        $this->setContainer($container);
    }

    /**
     * 
     * @return type
     */
    protected function inputs()
    {
        if (is_array($this->_request->getParsedBody())) {
            $callable = function($input) {
                return $input;
            };
            $inputs = array_keys($this->_request->getParsedBody());

            return array_filter(array_map($callable, $inputs));
        }

        return null;
    }

    /**
     * 
     * @return type
     */
    protected function jwt()
    {
        return $this->_container->jwt;
    }

    /**
     * 
     * @param type $key
     * @param type $default [Optional]
     * @return type
     */
    protected function param($key, $default = null)
    {
        return $this->_request->getParam($key, $default);
    }

    /**
     * 
     * @param string $content [Optional]
     * @param int $status [Optional]
     * @return type
     */
    protected function respond(string $content = '', int $status = 200)
    {
        $body = $this->_response->getBody();
        $body->write($content);

        return $this->_response->withStatus($status)->withBody($body);
    }

    /**
     * 
     * @param string $message
     * @param int $status [Optional]
     * @return type
     */
    protected function respondWithError(string $message, int $status = 404)
    {
        $response = [];
        if ($message) {
            $response['message'] = $message;
        }

        return $this->respond(json_encode($response), $status);
    }

    /**
     * 
     * @param int $status [Optional]
     * @return type
     */
    protected function respondWithNoContent(int $status = 200)
    {
        return $this->respond('', $status);
    }

    /**
     * 
     * @param string $message
     * @param int $status [Optional]
     * @return type
     */
    protected function respondWithSuccess(string $message, int $status = 200)
    {
        $response = [];
        if ($message) {
            $response['message'] = $message;
        }

        return $this->respond(json_encode($response), $status);
    }

    /**
     * 
     * @param array $errors
     * @return type
     */
    public function respondWithValidation(array $errors)
    {
        $response = [];
        $response['errors'] = $errors;
        $response['message'] = 'Some fields are not correctly sent';

        return $this->respond(json_encode($response), 400);
    }

    /**
     * 
     * @return type
     */
    protected function user()
    {
        return $this->jwt()->data;
    }

    /**
     * 
     * @param array $rules
     * @param array $inputs [Optional]
     * @return type
     */
    protected function validate(array $rules, array $inputs = [])
    {
        if ($inputs) {
            $array = [];
            foreach ($inputs as $input) {
                if (isset($rules[$input])) {
                    $array[$input] = $rules[$input];
                }
            }
            $rules = $array;
        }

        return $this->_container->validator->validate($this->_request, $rules);
    }

}

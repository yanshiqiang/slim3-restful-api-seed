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
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @category Base
 * @see https://github.com/andrewdyer/slim3-restful-api-seed
 */
abstract class Controller implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    /** @var Slim\Http\Request */
    private $_request;

    /** @var Slim\Http\Response */
    private $_response;

    /**
     * 
     * @param Interop\Container\ContainerInterface $container
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     */
    public function __construct(ContainerInterface $container, Request $request, Response $response)
    {
        $this->_request = $request;
        $this->_response = $response;
        $this->setContainer($container);
    }

    /**
     * 
     * @return array
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

        return [];
    }

    /**
     * 
     * @param string $key
     * @param string $default [Optional]
     * @return mixed
     */
    protected function param(string $key, string $default = '')
    {
        return $this->_request->getParam($key, $default);
    }

    /**
     * 
     * @param string $content
     * @param int $status [Optional]
     * @return Slim\Http\Response
     */
    protected function respond(string $content, int $status = 200)
    {
        $body = $this->_response->getBody();
        $body->write($content);

        return $this->_response->withStatus($status)->withBody($body);
    }

    /**
     * 
     * @param string $message
     * @param int $status [Optional]
     * @return Slim\Http\Response
     */
    protected function respondWithError(string $message, int $status = 404)
    {
        $response = [];
        $response['message'] = $message;

        return $this->respond(json_encode($response), $status);
    }

    /**
     * 
     * @param int $status [Optional]
     * @return Slim\Http\Response
     */
    protected function respondWithNoContent(int $status = 200)
    {
        return $this->respond('', $status);
    }

    /**
     * 
     * @param string $message
     * @param int $status [Optional]
     * @return Slim\Http\Response
     */
    protected function respondWithSuccess(string $message, int $status = 200)
    {
        $response = [];
        $response['message'] = $message;

        return $this->respond(json_encode($response), $status);
    }

    /**
     * 
     * @param array $errors
     * @return Slim\Http\Response
     */
    protected function respondWithValidation(array $errors)
    {
        $response = [];
        $response['errors'] = $errors;
        $response['message'] = 'Some fields are not correctly sent';

        return $this->respond(json_encode($response), 400);
    }

    /**
     * 
     * @param array $rules
     * @param array $inputs [Optional]
     * @return App\Validation\Validator
     * 
     * @todo Make this better!
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

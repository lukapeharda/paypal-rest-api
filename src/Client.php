<?php

namespace LukaPeharda\PayPal;

use LukaPeharda\PayPal\Error\HttpException;
use LukaPeharda\PayPal\Service\ServiceFactory;
use LukaPeharda\PayPal\Environment\EnvironmentFactory;

use PayPalHttp\HttpClient;
use PayPalHttp\Environment;
use PayPalHttp\HttpException as PayPalHttpException;

class Client
{
    /**
     * @var \PayPalHttp\HttpClient
     */
    protected $httpClient;

    /**
     * @var \LukaPeharda\PayPal\Service\ServiceFactory
     */
    private $serviceFactory;

    /**
     * Init HTTP client with given credentials for specified environment.
     *
     * @param   string  $clientId
     * @param   string  $clientSecret
     * @param   string  $environmentType
     */
    public function __construct($clientId, $clientSecret, $environmentType)
    {
        $environment = EnvironmentFactory::create($clientId, $clientSecret, $environmentType);

        $this->httpClient = new HttpClient($environment);
    }

    /**
     * Runs a request through the client.
     *
     * @param   string  $method
     * @param   string  $path
     * @param   array|null  $data
     *
     * @return  Response
     */
    public function request($method, $path, $data = [])
    {
        switch ($method) {
            case 'POST':
            case 'post':
                return $this->post($path, $data);
            case 'PATCH':
            case 'patch':
                return $this->patch($path, $data);
            case 'GET':
            case 'get':
            default:
                return $this->get($path);
        }
    }

    /**
     * Make a GET request.
     *
     * @param   string  $path
     *
     * @return  Response
     */
    public function get($path)
    {
        $request = new Request($path, 'GET');

        return $this->execute($request);
    }

    /**
     * Make a POST request.
     *
     * @param   string  $path
     * @param   array  $data
     *
     * @return  Response
     */
    public function post($path, $data = [])
    {
        $request = new Request($path, 'POST', $data);

        return $this->execute($request);
    }

    /**
     * Make a PATCH request.
     *
     * @param   string  $path
     * @param   array  $data
     *
     * @return  Response
     */
    public function patch($path, $data = [])
    {
        $request = new Request($path, 'PATCH', $data);

        return $this->execute($request);
    }

    /**
     * Execute request and wrap response (or exception) to own objects.
     *
     * @param   Request  $request
     *
     * @return  Response
     *
     * @throws  HttpException
     */
    protected function execute(Request $request)
    {
        $request->headers['Authorization'] = 'Basic ' . $this->httpClient->environment->authorizationString();
        $request->headers['Prefer'] = 'return=representation'; // return full objects instead of minimal ones

        try {
            return Response::fromBase($this->httpClient->execute($request));
        } catch (PayPalHttpException $exception) {
            throw HttpException::fromBase($exception);
        }
    }

    /**
     * Return one of the available service from the service factory container.
     *
     * @param   string  $name
     *
     * @return  \LukaPeharda\PayPal\Service\AbstractService
     */
    public function __get($name)
    {
        if ($this->serviceFactory === null) {
            $this->serviceFactory = new ServiceFactory($this);
        }

        return $this->serviceFactory->__get($name);
    }
}

<?php

namespace LMeuwly\Sendinblue\Http;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;

class HttpClient
{
    /** @var array */
    private $headers;

    public function __construct()
    {
        $this->headers = [];
    }

    /**
     * Accept headers
     */
    public function withHeaders(array $headers) : HttpClient
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * Prepare all available methods
     */
    public function get($url, $params=[])
    {
        return $this->send('GET', $url, $params);
    }

    public function post($url, $params=[])
    {
        return $this->send('POST', $url, $params);
    }

    public function put($url, $params=[])
    {
        return $this->send('PUT', $url, $params);
    }

    public function patch($url, $params=[])
    {
        return $this->send('PATCH', $url, $params);
    }

    public function delete($url, $params=[])
    {
        return $this->send('DELETE', $url, $params);
    }


    /**
     * private methods
     */

    private function send($method, $url, $params, $query=[])
    {        
        try {
            return new HttpResponse( (new GuzzleClient(['headers' => $this->headers]))->request($method, $url, $params) );
        } catch (ConnectException $e) {
            throw new ConnectionException($e->getMessage(), 0, $e);
        }
    }
}
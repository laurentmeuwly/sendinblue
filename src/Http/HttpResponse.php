<?php

namespace LMeuwly\Sendinblue\Http;

use Psr\Http\Message\ResponseInterface;

class HttpResponse
{
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;        
    }

    public function body(): string
    {
        return (string) $this->response->getBody();
    }

    public function json(): array
    {
        $result = json_decode($this->response->getBody(), true);
        return is_null($result) ? [] : $result;
    }

    public function header($header): string
    {
        return $this->response->getHeaderLine($header);
    }

    public function status(): int
    {
        return $this->response->getStatusCode();
    }
}
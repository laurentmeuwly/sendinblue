<?php

namespace LMeuwly\Sendinblue;

use Throwable;

class Sendinblue
{
    protected $api;    

    public function __construct($apikey)
    {
        if (!is_string($apikey)) {
            throw new \Exception("Sendinblue API key is required - use the 'SENDINBLUE_KEY' value in .env");
        }
        
        $this->api = new SendinblueApi($apikey);
    }

    public function getLists()
    {
        return $this->api->getLists();
    }
}

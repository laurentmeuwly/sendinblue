<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use LMeuwly\Sendinblue\SendinblueApi;
use Tests\TestCase;

class SendinblueTest extends TestCase
{
    private SendinblueApi $api;

    /** @before */
    public function prepare()
    {
        /*$secrets = require(__DIR__ . '/../secrets.php');
        if ($secrets['apitest'] !== true) {
            $this->markTestSkipped();
        }*/
        $this->api = new SendinblueApi('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');
        //$this->listId = $secrets['list'];
        //$this->domain = $secrets['domain'];
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //$sb = new Sendinblue(123, $this->api);  // throw an error
        //$sb = new Sendinblue('123', $this->api); // OK

        //$response = $this->api->getListContacts(2);
        //$response = $this->api->getList(2);
        $response = $this->api->subscribe('laurent+api3@lmeuwly.ch',2);
        //$response = $this->api->getLists();
        //$response = $this->api->getAttributes();
dd($response);
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

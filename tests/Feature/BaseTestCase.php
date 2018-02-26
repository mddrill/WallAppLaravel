<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;
use Illuminate\Foundation\Testing\TestResponse;

abstract class BaseTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    private function getError(TestResponse $response)
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode == 500) {
            if(is_null($content) || $content === false){
                return "No JSON was returned";
            }
            return "Failed to receive expected status code.\nGot status code $statusCode\n\"message\": "
                    . $content['message'] . "\nOn line "
                    . $content['line'] . " in "
                    . $content['file'];
        } else {
            return "Failed to receive expected status code.\nGot status code $statusCode";
        }
    }

    protected function assertStatusCode($expectedStatusCode, TestResponse $response)
    {
        $this->assertEquals($expectedStatusCode, $response->getStatusCode(), $this->getError($response));
    }
}

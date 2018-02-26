<?php

namespace Tests\Unit;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class BaseUnitTestCase extends TestCase
{
    public function assertHTTPExceptionStatus($expectedStatusCode, \Closure $codeThatShouldThrow)
    {
        try {
            $codeThatShouldThrow($this);
            $this->assertFalse(true, "An HttpException should have been thrown by the provided Closure.");
        } catch (HttpException $e) {
            $this->assertEquals(
                $expectedStatusCode,
                $e->getStatusCode(),
                sprintf("Expected an HTTP status of %d but got %d.", $expectedStatusCode, $e->getStatusCode())
            );
        }
    }

    public function assertMockedMethodRuns(\Closure $code)
    {
        try {
            $code($this);
        } catch (\Mockery\Exception\InvalidCountException $e) {
            $this->assertTrue(False, "Mocked method did not run");
        }
    }
}

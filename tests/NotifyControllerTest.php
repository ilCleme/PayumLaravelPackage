<?php

namespace Payum\LaravelPackage\Tests;

use Payum\Core\Exception\InvalidArgumentException;

class NotifyControllerTest extends TestCase
{
    /** @test */
    public function test_notify_unsafe_response_has_500_http_code_without_registered_gateway()
    {
        $gateway_name = 'not-exists';

        $response = $this
            ->call('GET', route('payum_notify_do_unsafe', ['gateway_name' => $gateway_name]))
            ->assertStatus(500)
        ;

        $exception = $response->exception;
        $expectedMessageException = sprintf('Gateway "%s" does not exist.', $gateway_name);
        $this->assertEquals(get_class($exception), InvalidArgumentException::class);
        $this->assertEquals($exception->getMessage(), $expectedMessageException);
    }


    /** @test */
    public function test_notify_unsafe_payum_receive_right_gateway_name_parameter()
    {
        $gateway_name = 'not-exists';

        $this
            ->mock('payum', function($mock) use ($gateway_name){
                $mock
                    ->shouldReceive('getGateway')
                    ->with($gateway_name)
                    ->once();
            });

        $response = $this
            ->call('GET', route('payum_notify_do_unsafe', ['gateway_name' => $gateway_name]))
        ;
    }
}

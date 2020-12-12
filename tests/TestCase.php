<?php

namespace Payum\LaravelPackage\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Payum\Core\PayumBuilder;
use Payum\LaravelPackage\PayumServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        /** @var PayumBuilder $payumBuilder */
        $payumBuilder = app('payum.builder');
        $payumBuilder = $payumBuilder->addDefaultStorages();
        $this->instance('payum.builder', $payumBuilder);
        $this->swap('payum', $payumBuilder->getPayum());
    }

    protected function getPackageProviders($app)
    {
        return [
            PayumServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        /*
        include_once __DIR__.'/../database/migrations/create_skeleton_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}

<?php

namespace Payum\LaravelPackage\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Payum\LaravelPackage\PayumServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        /*Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Payum\\PayumLaravelPackage\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );*/
    }

    protected function getPackageProviders($app)
    {
        return [
            PayumServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        /*$app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);*/

        /*
        include_once __DIR__.'/../database/migrations/create_payum_laravel_package_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}

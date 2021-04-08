<?php
/*
 * Copyright (c) 2021 Martijn Verhaegen <m@rtyn.io>
 */

namespace Martynv\LaravelUuidModels\Tests;


use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class TestCase
 *
 * @package Tests
 *
 * Description:
 *
 *      Basic test case
 *
 * @author the laravel authors
 */
abstract class TestCase extends BaseTestCase
{

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase(Application $app): void
    {
        $app['db']->connection()
            ->getSchemaBuilder()
            ->create('test_models', function (Blueprint $table): void {
                $table->uuid('id')->primary();
                $table->timestamps();
            });

        $app['db']->connection()
            ->getSchemaBuilder()
            ->create('test_user_models', function (Blueprint $table): void {
                $table->uuid('id')->primary();
                $table->timestamps();
            });


    }

}

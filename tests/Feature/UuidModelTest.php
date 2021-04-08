<?php
/*
 * Copyright (c) 2021 Martijn Verhaegen <m@rtyn.io>
 */

namespace Martynv\LaravelUuidModels\Tests;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Martynv\LaravelUuidModels\Tests\Fixtures\TestModel;
use Ramsey\Uuid\Uuid;

class UuidModelTest extends TestCase
{

    use RefreshDatabase;

    protected $testsModel = TestModel::class;
    protected $testsTable = 'test_models';

    public function testModelCanBeMade()
    {
        $model = $this->testsModel::make([]);
        $this->assertInstanceOf($this->testsModel, $model);
    }

    public function testModelCreationSetsId()
    {
        $model = $this->testsModel::create([]);
        $this->assertNotNull($model->id);
    }

    public function testModelCreationSetsValidUuid()
    {
        $model = $this->testsModel::create([]);
        $this->assertTrue(Uuid::isValid($model->id));
    }

    public function testModelCanBeCreated()
    {
        $model = $this->testsModel::create([]);
        $this->assertDatabaseHas($this->testsTable, ['id' => $model->id]);
    }

    public function testModelCanBeFoundById()
    {
        $model = $this->testsModel::create([]);

        $foundModel = $this->testsModel::find($model->id);
        $this->assertNotNull($foundModel);
    }

    public function testModelUuidCanBeSetManually()
    {
        $uuidToSet = Uuid::uuid4();
        $model     = $this->testsModel::create(['id' => $uuidToSet]);
        $this->assertDatabaseHas($this->testsTable, ['id' => $uuidToSet]);

        $model->refresh(); // Refresh the model so we actually get the values stored in the database

        $this->assertEquals($uuidToSet, $model->id);
    }

    public function testModelCanSetUuidV1() {
        Config::set('laravel-uuid-models.version', '1');

        $model = $this->testsModel::create();
        $uuidV4Regex = '/[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[0-9a-f]{4}-[0-9a-f]{12}|[0-9a-f]{12}4[0-9a-f]{19}/i';

        $matches = preg_match($uuidV4Regex, $model->id); // Tests by exclusion that the ID is not a UUIDv4
        $this->assertEquals(0, $matches);
    }

    public function testModelCanSetUuidV4() {
        Config::set('laravel-uuid-models.version', '1');
        $model = $this->testsModel::create();

        $uuidV4Regex = '/[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[0-9a-f]{4}-[0-9a-f]{12}|[0-9a-f]{12}4[0-9a-f]{19}/i';
        $matches = preg_match($uuidV4Regex, $model->id);
        $this->assertEquals(1, $matches);
    }

    public function testModelDefaultsToUuidV4() {
        Config::set('laravel-uuid-models.version', 'INVALID_CONFIG_VALUE');
        $model = $this->testsModel::create();

        $this->assertTrue(Uuid::isValid($model->id)); // Tests a valid UUID was set

        $uuidV4Regex = '/[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[0-9a-f]{4}-[0-9a-f]{12}|[0-9a-f]{12}4[0-9a-f]{19}/i';
        $matches = preg_match($uuidV4Regex, $model->id);
        $this->assertEquals(1, $matches);

    }
}

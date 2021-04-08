<?php
/*
 * Copyright (c) 2021 Martijn Verhaegen <m@rtyn.io>
 */

namespace Martynv\LaravelUuidModels\Tests;


use Martynv\LaravelUuidModels\Tests\Fixtures\TestUserModel;

class UuidUserModelTest extends UuidModelTest
{
    protected $testsModel = TestUserModel::class;
    protected $testsTable = 'test_user_models';
}

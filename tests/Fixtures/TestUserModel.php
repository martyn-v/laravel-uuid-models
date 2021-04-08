<?php
/*
 * Copyright (c) 2021 Martijn Verhaegen <m@rtyn.io>
 */

namespace Martynv\LaravelUuidModels\Tests\Fixtures;


use Martynv\LaravelUuidModels\Models\UuidUserModel;

class TestUserModel extends UuidUserModel
{
    protected $fillable = ['id'];
}

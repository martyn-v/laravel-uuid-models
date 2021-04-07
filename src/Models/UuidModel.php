<?php
/** @noinspection PhpMissingFieldTypeInspection */

/*
 * Copyright (c) 2021 Martijn Verhaegen <m@rtyn.io>
 */

namespace Martynv\LaravelUuidModels\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidModel
 *
 *
 * Description:
 *
 *
 *
 * @author martynv
 */
abstract class UuidModel extends Model
{

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * @var string
     */
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(
            function ($model) {
                // If the primary key is not set, or is not a valid UUID, we'll create a new one.
                if (empty($model->{$model->getKeyName()}) || !Uuid::isValid($model->{$model->getKeyName()})) {
                    $model->{$model->getKeyName()} = static::createUuid();
                }
            }
        );
    }

    /**
     * Creates a new UUID based on the version defined in our config.
     *
     * @return string
     */
    private static function createUuid(): string
    {
        $uuidType = config('laravel-uuid-models.version', '4');

        // Default = Uuid4;
        return match ($uuidType) {
            '1' => Uuid::uuid1(),
            default => Uuid::uuid4(),
        };
    }


}

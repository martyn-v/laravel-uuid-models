<?php
/*
 * Copyright (c) 2021 Martijn Verhaegen <m@rtyn.io>
 */

namespace Martynv\LaravelUuidModels\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;

/**
 * Class UuidUserModel
 *
 * @package Martynv\LaravelUuidModels\Models
 *
 * Description:
 *
 *
 *
 * @author martyn
 */
class UuidUserModel extends UuidModel implements AuthenticatableContract,
                                                 AuthorizableContract,
                                                 CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use MustVerifyEmail;
}

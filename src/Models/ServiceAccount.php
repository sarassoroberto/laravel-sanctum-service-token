<?php

namespace Arpitech\SanctumServiceToken\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class ServiceAccount extends Model implements AuthenticatableContract
{
    use Authenticatable, Authorizable, HasApiTokens;

    protected $guarded = [];
}

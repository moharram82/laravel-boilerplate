<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{

    protected $table = 'role_has_permissions';

    /**
     * The attributes that are guarded.
     *
     * @var array
     */
    protected $guarded = [];

    public $timestamps = false;
}

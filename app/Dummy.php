<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dummy extends Model
{
    protected $connection = "mysql2";

    protected $table = "dummies";
}

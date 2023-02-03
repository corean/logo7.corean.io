<?php

namespace App\Models;

use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Compoships;

    protected $table = 'corean_comment';
    protected $primaryKey = 'id';
    protected $dates = ['reg_date'];
}

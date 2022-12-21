<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    // use HasFactory;

    protected $table = 'mini_memo';
    protected $primaryKey = 'no';
    protected $dates = [
        //'time',
    ];
    protected $fillable = [
        'target_no',
        'from_no',
        'from_name',
        'ment',
        'time',
        'isread',
        'special'
    ];

}

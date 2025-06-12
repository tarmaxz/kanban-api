<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'board_id',
        'name',
    ];
}

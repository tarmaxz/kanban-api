<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'position',
        'name',
    ];

    public function board_categories()
    {
        return $this->hasMany(BoardCategory::class);
    }
}

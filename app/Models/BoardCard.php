<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardCard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'board_category_id',
        'position',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(BoardCategory::class);
    }
}

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
        'position',
        'name',
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function board_cards()
    {
        return $this->hasMany(BoardCard::class)->orderBy('position', 'asc');
    }
}

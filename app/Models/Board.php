<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\BoardCardScopes;

class Board extends Model
{
    use SoftDeletes, BoardCardScopes;

    protected $fillable = [
        'id',
        'name',
        'position'
    ];

    public function board_categories()
    {
        return $this->hasMany(BoardCategory::class)->orderBy('position', 'asc');
    }
}

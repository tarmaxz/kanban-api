<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\BoardCardScopes;

class BoardCard extends Model
{
    use SoftDeletes, BoardCardScopes;

    protected $fillable = [
        'id',
        'board_category_id',
        'user_id',
        'position',
        'name',
    ];

    public function category()
    {
        return $this->belongsTo(BoardCategory::class);
    }
}

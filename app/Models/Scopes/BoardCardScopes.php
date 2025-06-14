<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use App\Enums\UserType;

trait BoardCardScopes
{
    public function scopeVisibleByUser(Builder $query, $user)
    {
        if ($user->type_id === UserType::COLLABORATOR) {
            return $query->where('user_id', $user->id);
        }

        return $query;
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\BusinessException;
use App\Enums\UserType;

class PermissionService
{
    public function verify()
    {
        $user = Auth::user();
        if ($user->type_id === UserType::COLLABORATOR) {
            throw new BusinessException('Você não tem permissão para executar essa ação!');
        }
    }
}

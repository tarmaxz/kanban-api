<?php

namespace App\Enums;

enum UserType: int
{
    case COLLABORATOR = 1;
    case MANAGER = 2;
}

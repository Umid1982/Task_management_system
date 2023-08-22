<?php

namespace App\Console\Constants\ResponseConstants;

enum RoleResponseEnum: string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case EMPLOYEE = 'employee';
}

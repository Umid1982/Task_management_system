<?php

namespace App\Console\Constants\ResponseConstants;

enum UserResponseEnum:string
{
    case USERS_LIST = 'Users list';
    case USER_UPDATED = 'User updated';
    case USER_CREATE = 'User created';
    case USER_SHOW = 'User show';
    case USER_DELETED = 'User deleted';
    case USER_REGISTER = "User registered";
    case USER_LOGIN = "User login";
    case USER_PASSWORD_NEW = "User password new";
    case USER_PASSWORD_CHANGE = "User password change";
    case USER_ROLE_CREATE = "User role created";
    case USER_PERMISSION_CREATE = "User permission created";
    case ERROR = "Something went wrong, check Logs!";
}

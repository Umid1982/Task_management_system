<?php

namespace App\Console\Constants\ResponseConstants;

enum PermissionResponseEnum:string
{
    case  DELETE = 'delete';
    case  UPDATE = 'update';
    case  SHOW = 'show';
    case CREATE ='create';
}

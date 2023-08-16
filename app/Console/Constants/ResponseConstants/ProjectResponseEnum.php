<?php

namespace App\Console\Constants\ResponseConstants;

enum ProjectResponseEnum:string
{
    case PROJECT_LIST = 'Projects list';
    case PROJECT_UPDATED = 'Project updated';
    case PROJECT_CREATE = 'Project created';
    case PROJECT_SHOW = 'Project show';
    case PROJECT_DELETED = 'Project deleted';
    case PROJECT_DELETE_FAILED = "Project delete failed";
    case ERROR = "Something went wrong, check Logs!";
}

<?php

namespace App\Console\Constants\ResponseConstants;

enum TaskResponseEnum:string
{
    case TASK_LIST = 'Tasks list';
    case TASK_SHOW = 'Task chow';
    case TASK_STORE = 'Task store';
    case TASK_UPDATE = 'Task update';
    case TASK_DELETE = 'Task delete';
    case TASK_USER_CREATE = 'Task user created';
    case TASK_CHILDREN = 'Task children';
    case TASK_DELETE_FAILED = 'Teams delete failed';
    case ERROR = "Something went wrong, check Logs!";
}

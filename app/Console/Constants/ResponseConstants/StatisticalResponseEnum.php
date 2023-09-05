<?php

namespace App\Console\Constants\ResponseConstants;

enum StatisticalResponseEnum:string
{
    case STATISTICAL_LIST = 'Statistical list';
    case ERROR = "Something went wrong, check Logs!";
}

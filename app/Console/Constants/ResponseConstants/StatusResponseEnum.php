<?php

namespace App\Console\Constants\ResponseConstants;

enum StatusResponseEnum:string
{
 case NEW = 'new';
 case IN_PROGRESS = 'in_progress';
 case FINISHED = 'finished';

}

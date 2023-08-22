<?php

namespace App\Console\Constants\ResponseConstants;

enum TeamResponseEnum:string
{
    case TEAM_LIST = 'Teams list';
    case TEAM_SHOW = 'Team chow';
    case TEAM_STORE = 'Team store';
    case TEAM_UPDATE = 'Team update';
    case TEAM_DELETE = 'Team delete';
    case PARTICIPANT_TEAM_CREATE = 'Participant team created';
    case TEAM_DELETE_FAILED = 'Team delete failed';
    case ERROR = "Something went wrong, check Logs!";
}

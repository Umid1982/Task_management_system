<?php

namespace App\Console\Constants\ResponseConstants;

enum CommentResponseEnum:string
{
    case COMMENT_LIST = 'Comments list';
    case COMMENT_SHOW = 'Comment chow';
    case COMMENT_STORE = 'Comment store';
    case COMMENT_SEND= 'Comment send';
    case COMMENT_UPDATE = 'Comment update';
    case COMMENT_DELETE = 'Comment delete';
    case COMMENT_DELETE_FAILED = 'Comment delete failed';
    case ERROR = "Something went wrong, check Logs!";
}

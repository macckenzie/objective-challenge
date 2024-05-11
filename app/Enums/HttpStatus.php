<?php

namespace App\Enums;

enum HttpStatus: int
{
    case OK = 200;
    case CREATED = 201;
    case FOUND = 302;
    case NOT_FOUND = 404;
    case UNPROCESSABLE_CONTENT = 422;
    case INTERNAL_ERROR = 500;
}

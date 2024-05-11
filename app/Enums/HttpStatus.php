<?php

namespace App\Enums;

enum HttpStatus: int
{
    case OK = 200;
    case CREATED = 201;
    case NOT_FOUND = 404;
    case UNPROCESSABLE_CONTENT = 422;
}

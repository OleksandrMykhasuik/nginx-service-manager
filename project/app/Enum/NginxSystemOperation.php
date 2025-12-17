<?php

namespace App\Enum;

enum NginxSystemOperation
{
    case start;
    case stop;
    case restart;
    case reload;
}

<?php

namespace App\Enums;

enum StatusProp: string {
    case pending  = 'pending';
    case accepter = 'accepter';
    case refuser  = 'refuser';
}

<?php

namespace App\Enums;

enum RoleUser : string
{
    case admin = 'admin';
    case candidat = 'candidat';
    case recruteur = 'recruteur';
}

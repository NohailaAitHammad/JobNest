<?php

namespace App\Enums;

enum Role : string
{
    case admin = 'admin';
    case candidat = 'candidat';
    case recruteur = 'recruteur';
}

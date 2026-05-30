<?php

namespace App\Enums;

enum UserRole: string
{
    case Master = 'master';
    case Admin = 'admin';
    case SubAdmin = 'sub_admin';

    // Si es necesario se pueden agregar más opciones
}

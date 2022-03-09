<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum UserTypes: string
{
    use Names, Values;

    case Admin = 'admin';
    case Student = 'student';
}

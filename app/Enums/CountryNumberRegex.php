<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CountryNumberRegex extends Enum
{
    const CAMEROON   = '#\(237\)\ ?[2368]\d{7,8}$#';
    const ETHIOPIA   = '#\(251\)\ ?[1-59]\d{8}$#';
    const MOROCCO    = '#\(212\)\ ?[5-9]\d{8}$#';
    const MOZAMBIQUE = '#\(258\)\ ?[28]\d{7,8}$#';
    const UGANDA     = '#\(256\)\ ?\d{9}$#';
}
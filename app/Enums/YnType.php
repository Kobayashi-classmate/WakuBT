<?php

// app/Enums/YnType.php
namespace App\Enums;

enum YnType: int
{
    case No = 0;
    case Yes = 1;

    public function label(): string
    {
        return match ($this) {
            self::No => '否',
            self::Yes => '是',
        };
    }
}

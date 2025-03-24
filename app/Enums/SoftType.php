<?php

// app/Enums/SoftType.php
namespace App\Enums;

enum SoftType: int
{
    case LinuxPanel = 1;
    case WindowsPanel = 2;
    case Aapanel = 3;
    case BtMonitor = 4;
    case BtWaf = 5;

    public function label(): string
    {
        return match ($this) {
            self::LinuxPanel => 'Linux Panel',
            self::WindowsPanel => 'Windows Panel',
            self::Aapanel => 'Aapanel',
            self::BtMonitor => 'Bt Monitor',
            self::BtWaf => 'Bt Waf',
        };
    }
}

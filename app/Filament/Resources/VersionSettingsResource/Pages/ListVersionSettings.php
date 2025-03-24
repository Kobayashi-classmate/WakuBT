<?php

namespace App\Filament\Resources\VersionSettingsResource\Pages;

use App\Filament\Resources\VersionSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

use Filament\Notifications\Notification;

class ListVersionSettings extends ListRecords
{
    protected static string $resource = VersionSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 显示创建按钮
            //     Actions\CreateAction::make(),
        ];
    }
}

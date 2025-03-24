<?php

namespace App\Filament\Resources\VersionSettingsResource\Pages;

use App\Filament\Resources\VersionSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVersionSettings extends EditRecord
{
    protected static string $resource = VersionSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 显示删除按钮
            // Actions\DeleteAction::make(),
        ];
    }
}

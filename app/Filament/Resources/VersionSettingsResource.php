<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VersionSettingsResource\Pages;
use App\Filament\Resources\VersionSettingsResource\RelationManagers;
use App\Models\VersionSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Enums\SoftType;
use App\Enums\YnType;

class VersionSettingsResource extends Resource
{
    protected static ?string $model = VersionSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('software_name')
                    ->label('软件名称')
                    ->required()
                    ->options(self::getSoftOptions())
                    ->enum(SoftType::class)
                    ->disabledOn('edit'),
                Forms\Components\TextInput::make('version_number')
                    ->label('版本号')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('release_date')
                    ->label('发布时间')
                    ->required(),
                Forms\Components\Select::make('is_enabled')
                    ->label('是否启用')
                    ->required()
                    ->options(self::getYnOptions())
                    ->enum(YnType::class),
                Forms\Components\Select::make('is_visible')
                    ->label('是否展示')
                    ->required()
                    ->options(self::getYnOptions())
                    ->enum(YnType::class),
                Forms\Components\Textarea::make('change_log')
                    ->label('更新日志')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('software_name')
                    ->label('软件名称')
                    ->formatStateUsing(fn($state) => SoftType::tryFrom($state)?->label()),
                Tables\Columns\TextColumn::make('version_number')
                    ->label('版本号'),
                Tables\Columns\TextColumn::make('release_date')
                    ->label('发布时间'),
                Tables\Columns\CheckboxColumn::make('is_enabled')
                    ->label('是否启用'),
                Tables\Columns\CheckboxColumn::make('is_visible')
                    ->label('是否展示'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            // 批量操作
            // ->bulkActions([
            //     Tables\Actions\BulkActionGroup::make([
            //         Tables\Actions\DeleteBulkAction::make(),
            //     ]),
            // ])
            // 禁用分页
            ->paginated(false)
            ->recordUrl(null)
            ->recordAction(null);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVersionSettings::route('/'),
            'create' => Pages\CreateVersionSettings::route('/create'),
            'edit' => Pages\EditVersionSettings::route('/{record}/edit'),
        ];
    }

    public static function getSoftOptions(): array
    {
        return [
            SoftType::LinuxPanel->value => SoftType::LinuxPanel->label(),
            SoftType::WindowsPanel->value => SoftType::WindowsPanel->label(),
            SoftType::Aapanel->value => SoftType::Aapanel->label(),
            SoftType::BtMonitor->value => SoftType::BtMonitor->label(),
            SoftType::BtWaf->value => SoftType::BtWaf->label(),
        ];
    }

    public static function getYnOptions(): array
    {
        return [
            YnType::No->value => YnType::No->label(),
            YnType::Yes->value => YnType::Yes->label(),
        ];
    }
}

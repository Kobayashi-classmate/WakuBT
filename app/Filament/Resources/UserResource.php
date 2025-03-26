<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->label('昵称')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->label('邮箱')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(User::class, 'email', ignoreRecord: true),
            PhoneInput::make('mobile')
                ->label('手机号')
                ->required()
                ->unique(User::class, 'mobile', ignoreRecord: true)
                ->rules(['phone'])
                ->ipLookup(function () {
                    return rescue(fn () => Http::get('https://ipinfo.io/json')->json('country'), app()->getLocale(), report: false);
                })
                ->displayNumberFormat(PhoneInputNumberType::NATIONAL),
            Forms\Components\TextInput::make('password')
                ->label('密码')
                ->password()
                ->confirmed()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create')
                ->maxLength(255),
            Forms\Components\TextInput::make('password_confirmation')
                ->label('重复密码')
                ->password()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\ImageColumn::make('avatar_url')
                ->label('头像'),
            Tables\Columns\TextColumn::make('name')
                ->label('昵称')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->label('邮箱')
                ->searchable(),
            Tables\Columns\TextColumn::make('mobile')
                ->label('手机号')
                ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}

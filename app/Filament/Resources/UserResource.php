<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->unique()
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label(__('Password'))
                    ->required()
                    ->password()
                    ->rule(Password::default())
                    ->same('passwordConfirmation'),
                Forms\Components\TextInput::make('passwordConfirmation')
                    ->label(__('Confirm Password'))
                    ->required()
                    ->password(),
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('user');
    }

    public static function getNavigationLabel(): string
    {
        return __('User');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query
                    ->where('id', '!=', auth()->id())
                    ->when(auth()->user()->hasRole('team administrator'), function (Builder $query) {
                    return $query->where('team_id', auth()->user()->team_id);
                });
            })
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Change Password')
                    ->authorize('update')
                    ->icon('heroicon-o-key')
                    ->form([
                        Forms\Components\TextInput::make('password')
                            ->label(__('Password'))
                            ->required()
                            ->password()
                            ->rule(Password::default())
                            ->same('passwordConfirmation'),
                        Forms\Components\TextInput::make('passwordConfirmation')
                            ->label(__('Confirm Password'))
                            ->required()
                            ->password(),
                    ])
                    ->action(function (User $user, array $data) {
                        $user->update(['password' => $data['password']]);

                        Notification::make()
                            ->success()
                            ->title(__('Password Changed'))
                            ->send();
                    })
            ])
            ->bulkActions([
                //
            ]);
    }
}

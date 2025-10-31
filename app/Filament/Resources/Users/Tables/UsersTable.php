<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name')),
                TextColumn::make('email')
                    ->label(__('Email'))
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
            ->recordActions([
                Action::make('changePassword')
                    ->label(__('Change password'))
                    ->authorize('update')
                    ->icon('heroicon-o-key')
                    ->form([
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->rule(Password::default())
                            ->same('passwordConfirmation')
                            ->dehydrateStateUsing(fn (string $state): string => $state)
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create'),
                        TextInput::make('passwordConfirmation')
                            ->label(__('Confirm password'))
                            ->password()
                            ->dehydrated(false)
                            ->required(),
                    ])
                    ->action(function (User $user, array $data) {
                        $user->update(['password' => $data['password']]);

                        Notification::make()
                            ->success()
                            ->title(__('Password changed'))
                            ->send();
                    })
            ])
            ->toolbarActions([
            ]);
    }
}

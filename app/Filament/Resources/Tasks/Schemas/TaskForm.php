<?php

namespace App\Filament\Resources\Tasks\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('description')
                    ->label(__('Description'))
                    ->maxLength(1024)
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}

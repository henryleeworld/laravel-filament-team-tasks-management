<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\Role;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateDataUsing(function (array $data) {
                    $role = Role::where('name', 'user')->first();

                    $data['role_id'] = $role->id;
                    $data['team_id'] = auth()->user()->team_id;

                    return $data;
                }),
        ];
    }
}

<?php

namespace App\Listeners;

use App\Models\Role;
use App\Models\User;
use Filament\Auth\Events\Registered;

class CreateUsersTeam
{
    public function handle(Registered $event): void
    {
        $user = $event->getUser();

        $role = Role::where('name', 'team administrator')->first();

        $team = $user->ownedTeam()->create(['name' => $user->name . __('\'s Team')]);

        $user->update([
            'role_id' => $role->id,
            'team_id' => $team->id,
        ]);
    }
}

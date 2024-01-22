<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ForceLogin
{
    public function handle($request, Closure $next)
    {
        if (! Filament::auth()->hasUser()) {
            Model::unguard();
            $user = User::query()->firstOrCreate(
                [
                    'name' => 'The best Pokemon Trainer',
                    'email' => 'satoshi@oaklabs.pok',
                ], [
                    'password' => Hash::make('drOakIsMyNewDad'),
                ]
            );
            Model::reguard();
            Filament::auth()->login($user);
        }

        return $next($request);
    }
}

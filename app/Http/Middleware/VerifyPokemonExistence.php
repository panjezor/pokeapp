<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Pokemon;
use App\Services\PokeAPIService;

class VerifyPokemonExistence
{
    public function __construct(private PokeAPIService $service)
    {
    }

    public function handle($request, \Closure $next)
    {
        if (Pokemon::query()->count() === 0) {
            $this->service->pullAll();
        }

        return $next($request);
    }
}

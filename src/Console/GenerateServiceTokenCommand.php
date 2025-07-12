<?php

namespace Arpitech\SanctumServiceToken\Console;

use Illuminate\Console\Command;
use Arpitech\SanctumServiceToken\Services\TokenService;

class GenerateServiceTokenCommand extends Command
{
    protected $signature = 'service:generate-token {name}';
    protected $description = 'Generate Sanctum token for service account';

    public function handle(TokenService $tokenService)
    {
        $token = $tokenService->generateToken($this->argument('name'));
        
        $this->info("Token generato:");
        $this->line($token);
        $this->newLine();
        $this->line('⚠️  Salvare questo token in un luogo sicuro!');
    }
}

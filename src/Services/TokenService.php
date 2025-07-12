<?php

namespace Arpitech\SanctumServiceToken\Services;

use Arpitech\SanctumServiceToken\Models\ServiceAccount;

class TokenService
{
    public function generateToken(string $tokenName): string
    {
        $account = ServiceAccount::firstOrCreate([
            'name' => $tokenName
        ], [
            'description' => "Service account for {$tokenName}",
            'is_active' => true,
        ]);
        
        return $account->createToken(
            $tokenName,
            ['service:access'],
            now()->addYears(5)
        )->plainTextToken;
    }

    public function createServiceToken(string $serviceName, string $description = null): array
    {
        $account = ServiceAccount::firstOrCreate([
            'name' => $serviceName
        ], [
            'description' => $description ?? "Service account for {$serviceName}",
            'is_active' => true,
        ]);
        
        $token = $account->createToken(
            $serviceName,
            ['service:access'],
            now()->addYears(5)
        )->plainTextToken;

        return [
            'service_account' => $account,
            'token' => $token,
        ];
    }
}

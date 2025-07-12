<?php

namespace Arpitech\SanctumServiceToken\Services;

use Arpitech\SanctumServiceToken\Models\ServiceAccount;

class TokenService
{
    public function generateToken(string $tokenName): string
    {
        $account = ServiceAccount::firstOrCreate(['name' => $tokenName]);
        
        return $account->createToken(
            $tokenName,
            ['service:access'],
            now()->addYears(5)
        )->plainTextToken;
    }
}

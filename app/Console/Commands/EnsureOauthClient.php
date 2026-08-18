<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;

#[Signature('app:ensure-oauth-client')]
#[Description('Creates the CONFIA Admin Panel password-grant OAuth client if it does not already exist.')]
class EnsureOauthClient extends Command
{
    public function handle(ClientRepository $clients): int
    {
        $existing = Passport::client()->newQuery()
            ->where('name', 'CONFIA Admin Panel')
            ->first();

        if ($existing) {
            $this->info("Cliente OAuth ya existe: {$existing->id}");

            return self::SUCCESS;
        }

        $client = $clients->createPasswordGrantClient('CONFIA Admin Panel', null, confidential: false);

        $this->info("Cliente OAuth creado: {$client->id}");

        return self::SUCCESS;
    }
}

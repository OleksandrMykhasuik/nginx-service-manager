<?php

namespace App\DTO;

class CreateVhostDTO
{
    public function __construct(
        public readonly string $domain,
        public readonly int $port,
        public readonly string $rootPath,
        public readonly bool $ssl,
        public readonly ?string $sslCertPath,
        public readonly ?string $sslKeyPath,
    ) {
    }
}

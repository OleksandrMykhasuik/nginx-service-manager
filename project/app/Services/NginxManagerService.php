<?php

namespace App\Services;

use App\DTO\CreateVhostDTO;
use App\Enum\AnsiblePlaybook;
use App\Enum\NginxSystemOperation;
use App\Infrastructure\Ansible\AnsibleClient;

class NginxManagerService
{
    public function __construct(private readonly AnsibleClient $ansibleClient)
    {
    }

    public function createVhost(CreateVhostDTO $dto): void
    {
        $this->ansibleClient->runPlaybook(
            AnsiblePlaybook::CREATE_VHOST,
            [
                'vhost_domain' => $dto->domain,
                'vhost_port' => $dto->port,
                'root_path' => $dto->rootPath,
                'vhost_ssl' => $dto->ssl,
                'vhost_ssl_cert_path' => $dto->sslCertPath ?? '',
                'vhost_ssl_key_path' => $dto->sslKeyPath ?? '',
            ]
        );
    }

    public function deleteVhost(string $domain): void
    {
        $this->ansibleClient->runPlaybook(
            AnsiblePlaybook::DELETE_VHOST,
            [
                'vhost_domain' => $domain,
            ]
        );
    }

    public function exec(NginxSystemOperation $command): void
    {
        $this->ansibleClient->runPlaybook(
            AnsiblePlaybook::NGINX_SYSTEM_OPERATION,
            ['nginx_action' => $command->name],
        );
    }
}

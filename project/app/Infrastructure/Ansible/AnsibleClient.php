<?php

namespace App\Infrastructure\Ansible;

use App\Enum\AnsiblePlaybook;
use Symfony\Component\Process\Process;

class AnsibleClient
{
    private string $sshHost;
    private string $sshUser;
    private string $sshKey;
    private string $ansiblePath;

    public function __construct()
    {
        $this->sshHost = config('ansible.host');
        $this->sshUser = config('ansible.user');
        $this->sshKey = config('ansible.ssh_key');
        $this->ansiblePath = config('ansible.path');
    }

    public function runPlaybook(
        AnsiblePlaybook $playbook,
        array $extraVars = []
    ): void {
        $command = $this->buildCommand($playbook, $extraVars);

        $process = new Process($command);
        $process->setTimeout(60);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new AnsibleException(
                \sprintf(
                    "Ansible failed:\n%s",
                    $process->getErrorOutput() ?: $process->getOutput(),
                )
            );
        }
    }

    private function buildCommand(AnsiblePlaybook $playbook, array $extraVars): array
    {
        $cmd = [
            'ssh',
            '-i', $this->sshKey,
            '-o', 'StrictHostKeyChecking=no',
            '-o', 'UserKnownHostsFile=/dev/null',
            '-o', 'LogLevel=ERROR',
            "{$this->sshUser}@{$this->sshHost}",
            'ansible-playbook',
            "{$this->ansiblePath}/playbooks/{$playbook->value}",
            '--extra-vars',
            escapeshellarg(json_encode($extraVars, JSON_THROW_ON_ERROR)),
        ];

        return $cmd;
    }
}

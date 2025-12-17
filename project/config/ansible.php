<?php

return [
    'host' => env('ANSIBLE_HOST', 'ansible'),
    'user' => env('ANSIBLE_USER', 'ansible'),
    'ssh_key' => env('ANSIBLE_SSH_KEY', '/var/www/.ssh/id_rsa'),
    'path' => env('ANSIBLE_PATH', '/ansible'),
];

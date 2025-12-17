<?php

namespace App\Enum;

enum AnsiblePlaybook: string
{
    case CREATE_VHOST = 'nginx-create-vhost.yml';
    case DELETE_VHOST = 'nginx-delete-vhost.yml';
    case NGINX_SYSTEM_OPERATION = 'nginx-sys-operation.yml';
}

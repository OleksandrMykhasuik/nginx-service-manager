#!/bin/bash

if [ -f /data/ssh/laravel_ansible.pub ]; then
    cat /data/ssh/laravel_ansible.pub >> /home/ansible/.ssh/authorized_keys
    chown ansible:ansible /home/ansible/.ssh/authorized_keys
    chmod 600 /home/ansible/.ssh/authorized_keys
    cp /data/ssh/laravel_ansible /home/ansible/.ssh/
    chown ansible:ansible /home/ansible/.ssh/laravel_ansible
    chmod 600 /home/ansible/.ssh/laravel_ansible
fi

exec /usr/sbin/sshd -D

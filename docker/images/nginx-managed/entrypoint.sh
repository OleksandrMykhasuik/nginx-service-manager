#!/bin/bash
set -e

if [ ! -f /etc/ssh/ssh_host_rsa_key ]; then
    ssh-keygen -A
fi

if [ -f /data/ssh/laravel_ansible.pub ]; then
    cat /data/ssh/laravel_ansible.pub >> /home/ansible/.ssh/authorized_keys
    chown ansible:ansible /home/ansible/.ssh/authorized_keys
    chmod 600 /home/ansible/.ssh/authorized_keys
fi


/usr/sbin/sshd -D &

nginx

wait -n

#!/bin/sh
set -e

SSH_DIR=/var/www/.ssh
mkdir -p $SSH_DIR
chmod 700 $SSH_DIR

if [ ! -f $SSH_DIR/laravel_ansible ]; then
    ssh-keygen -t ed25519 -f $SSH_DIR/laravel_ansible -N "" -C "laravel-to-ansible"
fi

mkdir -p /root/.ssh

cp $SSH_DIR/laravel_ansible.pub /data/ssh-public/laravel_ansible.pub

echo  "Host *" >> /root/.ssh/config
echo  " StrictHostKeyChecking no" >> /root/.ssh/config
echo  " UserKnownHostsFile=/dev/null" >> /root/.ssh/config
chmod 600 /root/.ssh/config

cd /var/www/public_html

while [ ! -f artisan ]; do
  echo "Waiting for artisan..."
  sleep 1
done

exec php artisan serve --host=0.0.0.0 --port=8000

#!/bin/bash

echo "$SSH_USER:$SSH_PASSWORD" | chpasswd

env | grep _ >> /root/.ssh/environment

service cron start
ulimit -s unlimited

/usr/bin/supervisord
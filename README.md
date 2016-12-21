#Yii blog

####Install Docker:
```
wget -qO- https://get.docker.com/ | sh
sudo usermod -aG docker user (and relogin !!!)
sudo apt-get install python-pip
sudo pip install docker-compose
```

#### Install and run

1. /etc/hosts 127.0.0.1 yii.dev
2. cd host/dev && docker-compose build && docker-compose up -d
3. http://yii.dev:30025/ 
    - host: mysql_yii
    - user: root
    - pass: root
4. CREATE DATABASE blog CHARACTER SET utf8 COLLATE utf8_unicode_ci
5. docker exec -u yiiuser php_yii /bin/bash -c "cd /home/yiiuser/source && composer install"
6. docker exec -u yiiuser php_yii /bin/bash -c "cd /home/yiiuser/source && php yii migrate/up --interactive=0"
7. http://yii.dev:30020/

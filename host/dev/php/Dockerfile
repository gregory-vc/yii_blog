FROM php:7.0.9-fpm
MAINTAINER Gregory Vorozhtcov

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-enable pdo
RUN docker-php-ext-enable pdo_mysql

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        curl

RUN apt-get update

RUN apt-get install -y \
    libcurl4-gnutls-dev \
    libc-client-dev

RUN apt-get install -y \
    imagemagick \
    unzip \
    mysql-client

RUN apt-get install -y libtool autoconf automake gcc pkg-config make curl
RUN apt-get install -y librabbitmq-dev re2c imagemagick

RUN curl -sS https://pecl.php.net/get/amqp-1.7.1.tgz -o amqp-1.7.1.tgz \
    && mkdir -p /usr/src/php/amqp \
    && tar -xof amqp-1.7.1.tgz -C /usr/src/php/amqp --strip-components=1 \
    && rm amqp-1.7.1.tgz \
    && cd /usr/src/php/amqp \
    && phpize \
    && ./configure \
    && make \
    && make install

RUN apt-get install -y net-tools
RUN docker-php-ext-enable amqp
RUN docker-php-ext-install mbstring
RUN docker-php-ext-enable mbstring

RUN curl -o /bin/phpcs https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar
RUN chmod a+x /bin/phpcs
RUN curl -LsS http://codeception.com/codecept.phar -o /usr/local/bin/codecept
RUN chmod a+x /usr/local/bin/codecept
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install gd
RUN docker-php-ext-install curl
RUN docker-php-ext-install iconv
RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install gettext
RUN docker-php-ext-install ctype
RUN docker-php-ext-install json
RUN docker-php-ext-install hash
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install session
RUN docker-php-ext-install sockets
RUN docker-php-ext-install zip
RUN docker-php-ext-install exif
RUN docker-php-ext-install phar
RUN docker-php-ext-install calendar
RUN docker-php-ext-install opcache
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install sysvsem
RUN docker-php-ext-install sysvmsg
RUN docker-php-ext-install sysvshm

RUN apt-get update
RUN apt-get install -y supervisor

RUN apt-get update && apt-get install -y percona-toolkit

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-enable intl

RUN apt-get update && apt-get install -y libmemcached-dev \
&& pecl install memcache

RUN apt-get update && apt-get install -y git

RUN mkdir /home/yiiuser/
RUN useradd yiiuser
RUN usermod -u 1000 -s /bin/bash yiiuser
RUN groupmod -g 1000 yiiuser
RUN usermod -d /home/yiiuser/ yiiuser
RUN chown -R yiiuser:yiiuser /home/yiiuser
RUN apt-get update && apt-get -y install sudo
RUN adduser yiiuser sudo
WORKDIR /home/yiiuser/source/

RUN sed -i -e "s/www-data/yiiuser/g" /usr/local/etc/php-fpm.d/www.conf

RUN mkdir /var/log/dev_php/

RUN touch /var/log/dev_php/php_error.log

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get update && \
    apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libgmp-dev \
        libxml2-dev \
        php-pear \
        curl \
        zlib1g-dev \
        libncurses5-dev \
        libldap2-dev \
        libicu-dev \
        libmemcached-dev \
        libcurl4-openssl-dev \
        ssmtp \
        cron
RUN docker-php-ext-install soap


ADD ./php.ini /usr/local/etc/php/php.ini
ADD ./php.ini /usr/local/etc/php.ini

RUN apt-get install -y openssh-server
RUN mkdir /var/run/sshd
RUN sed -ri 's/^PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config
RUN mkdir /root/.ssh/

ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y libssl-dev libc-client2007e-dev libkrb5-dev
RUN docker-php-ext-configure imap --with-imap-ssl --with-kerberos \
        && docker-php-ext-install imap

RUN apt-get update && apt-get install -y vim nano

RUN apt-get update && apt-get install -y locales
RUN	\
	   echo "ru_RU.UTF-8 UTF-8" >> /etc/locale.gen \
	&& echo "en_US.UTF-8 UTF-8" >> /etc/locale.gen \
	&& echo "en_GB.UTF-8 UTF-8" >> /etc/locale.gen \
	&& locale-gen \
	&& /usr/sbin/update-locale LANG=en_US.UTF-8
ENV LANG en_US.UTF-8
ENV LC_ALL en_US.UTF-8
ENV LC_CTYPE UTF-8
ENV LANGUAGE en_US.UTF-8

RUN localedef -i en_US -f UTF-8 en_US.UTF-8 \
  && localedef -i ru_RU -f UTF-8 ru_RU.UTF-8 \

  # set default locale
  && echo "\
      LANGUAGE=en_US.UTF-8\n\
      LC_ALL=en_US.UTF-8\n\
      LC_CTYPE=UTF-8\n\
      LANG=en_US.UTF-8\n"\
      > /etc/default/locale \

  # set keyboard setting
  && echo "\
      XKBMODEL=pc105\n\
      XKBLAYOUT=us,ru\n\
      XKBVARIANT=,\n\
      XKBOPTIONS=grp:alt_shift_toggle,grp_led:scroll"\
      >> /etc/default/keyboard
ADD ./bash_profile /home/yiiuser/.bash_profile
ADD ./bashrc /home/yiiuser/.bashrc
RUN chown -R yiiuser:yiiuser /home/yiiuser

RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php
RUN php composer-setup.php
RUN mv composer.phar /bin/composer
RUN chmod a+x /bin/composer
RUN php -r "unlink('composer-setup.php');"
RUN mkdir mysql_ext && cd mysql_ext && git clone https://github.com/php/pecl-database-mysql.git .
RUN cd mysql_ext && phpize && ./configure && make && make install && docker-php-ext-enable mysql

RUN apt-get update && apt-get install -y libmemcached-dev
RUN curl -sSL -o php7.zip https://github.com/websupport-sk/pecl-memcache/archive/php7.zip \
    && unzip php7 \
    && cd pecl-memcache-php7 \
    && /usr/local/bin/phpize \
    && ./configure --with-php-config=/usr/local/bin/php-config \
    && make \
    && make install \
    && docker-php-ext-enable memcache

RUN echo "PermitUserEnvironment yes" >> /etc/ssh/sshd_config
RUN mkdir /home/yiiuser/.ssh

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 22 9000

ADD ./start.sh /start.sh
RUN chmod 755 /start.sh
CMD ["/bin/bash", "/start.sh"]
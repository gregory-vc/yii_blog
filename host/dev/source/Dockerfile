FROM       ubuntu:trusty
MAINTAINER Gregory Vorozhtcov

ENV U_ID 1000
ENV G_ID 1000

# language
RUN locale-gen en_US.UTF-8
RUN locale-gen ru_RU.UTF-8
ENV LANG en_US.UTF-8
ENV LC_ALL en_US.UTF-8
ENV DEBIAN_FRONTEND noninteractive
RUN dpkg-reconfigure locales

# update soft
RUN apt-get update -y
RUN apt-get -y dist-upgrade
RUN apt-get upgrade -y
RUN apt-get install software-properties-common -y

# ssh
RUN apt-get install -y openssh-server
RUN mkdir /var/run/sshd
RUN sed -ri 's/^PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config
RUN mkdir /root/.ssh/

# git
RUN apt-get install -y git vim
RUN apt-get install -y ca-certificates git-core ssh
RUN eval "$(ssh-agent -s)"

RUN mkdir /home/yiiuser/
RUN useradd yiiuser
RUN usermod -u $U_ID -s /bin/bash yiiuser
RUN groupmod -g $G_ID yiiuser

RUN mkdir /home/yiiuser/.ssh
# ADD .id_rsa /home/yiiuser/.ssh/id_rsa
RUN mkdir /home/yiiuser/source/
# RUN chmod 600 /home/yiiuser/.ssh/id_rsa
# RUN echo "Host gitlab.com\n\tIdentityFile /home/yiiuser/.ssh/id_rsa" >> /home/yiiuser/.ssh/config
RUN eval "$(ssh-agent -s)"
RUN touch /home/yiiuser/.ssh/known_hosts
RUN ssh-keyscan bitbucket.org >> /home/yiiuser/.ssh/known_hosts
RUN chown -R yiiuser:yiiuser /home/yiiuser/
RUN apt-get update && apt-get -y install sudo
RUN adduser yiiuser sudo

RUN apt-get update && apt-get install -y mc vim

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

# open port
EXPOSE 22

VOLUME /home/yiiuser/source/

# container init
ADD ./start.sh /start.sh
RUN chmod 755 /start.sh
CMD ["/bin/bash", "/start.sh"]
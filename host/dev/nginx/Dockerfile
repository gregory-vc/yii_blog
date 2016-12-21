FROM nginx:1.9
MAINTAINER Gregory Vorozhtcov

ENV U_ID 1000
ENV G_ID 1000

COPY site.conf /etc/nginx/sites-available/site.conf
RUN mkdir /etc/nginx/sites-enabled
RUN ln -s /etc/nginx/sites-available/site.conf /etc/nginx/sites-enabled/site.conf

RUN useradd yiiuser
RUN usermod -u $U_ID -s /bin/bash yiiuser
RUN groupmod -g $G_ID yiiuser

COPY nginx.conf /nginx.conf

# container init
ADD ./start.sh /start.sh
RUN chmod 755 /start.sh
CMD ["/bin/bash", "/start.sh"]
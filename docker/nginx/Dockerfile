FROM nginx:alpine

RUN rm /etc/nginx/conf.d/default.conf

ADD /docker/nginx/nginx.conf /etc/nginx/
ADD /docker/nginx/symfony.conf /etc/nginx/conf.d/abipon.conf

ADD / /abipon

EXPOSE 80
EXPOSE 443
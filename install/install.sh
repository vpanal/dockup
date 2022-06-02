#!/bin/bash
docker build -t custom .
docker-compose up -d
domain=$1
file=$domain.yml

echo 'site-'$domain':'>>$file
echo '  image:  custom'>>$file
echo '  restart: always'>>$file
echo '  expose:'>>$file
echo '    - "80"'>>$file
echo '    - "8080"'>>$file
echo '  volumes:'>>$file
echo '    - /etc/dockup/mountpoint:/var/www/html:ro'>>$file
echo '  environment:'>>$file
echo '    - VIRTUAL_HOST='$domain>>$file
docker-compose -f $file up -d

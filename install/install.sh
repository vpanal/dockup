#!/bin/bash
docker build -t custom .
docker-compose up -d
domain=$1

echo 'site-'$domain':'>>$domain
echo '  image:  custom'>>$domain
echo '  restart: always'>>$domain
echo '  expose:'>>$domain
echo '    - "80"'>>$domain
echo '    - "8080"'>>$domain
echo '  volumes:'>>$domain
echo '    - /etc/dockup/mountpoint:/var/www/html:ro'>>$domain
echo '  environment:'>>$domain
echo '    - VIRTUAL_HOST='$domain>>$domain
docker-compose -f $domain.yml up -d
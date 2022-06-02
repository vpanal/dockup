#!/bin/bash
subdomain=$1
domain=$2
url=$3
file=$subdomain.$domain.yml
domainurl=$subdomain.$domain
mkdir/usr/dockup/mountpoint/$subdomain

if [[ $? -ne 0 ]]
then
 error1=$(echo "error in step one")
 date_output=$(date)
 echo "$date_output created $domainurl $error" >> /var/log/dockup/docker.log
 exit 1
fi

git clone $url/usr/dockup/mountpoint/$subdomain


if [[ $? -ne 0 ]]
then
 error=$(echo "error in step two")
 date_output=$(date)
 echo "$date_output created $domainurl $error" >> /var/log/dockup/docker.log
 ./delete.sh $1 $2 $3 
 exit 1
fi

echo 'site-'$subdomain.$domain':'>>$file
echo '  image:  alvie97/php-mysqli-apache'>>$file
echo '  restart: always'>>$file
echo '  expose:'>>$file
echo '    - "80"'>>$file
echo '    - "8080"'>>$file
echo '  volumes:'>>$file
echo '    -/usr/dockup/mountpoint'/$subdomain':/var/www/html:ro'>>$file
echo '  environment:'>>$file
echo '    - VIRTUAL_HOST='$subdomain.$domain>>$file
docker-compose -f $file up -d

if [[ $? -ne 0 ]]
then
 error=$(echo "error in step three")
 date_output=$(date)
 echo "$date_output created $domainurl $error" >> /var/log/dockup/docker.log
 ./delete.sh $1 $2 $3 
 rm $file
 exit 1
fi

rm $file

date_output=$(date)
echo "$date_output created $domainurl" >> /var/log/dockup/docker.log

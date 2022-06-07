#!/bin/bash
subdomain=$1
domain=$2
fulldom=$subdomain.$domain
prefix='install_site-'
sufix='_1'
docker_output=$(docker stop $prefix$fulldom$sufix)

if [[ $? -ne 0 ]]
then
 domainurl=$subdomain.$domain
 error=$(echo "error in step one")
 date_output=$(date)
 echo "$date_output created $domain.url $error" >> /var/log/dockup/docker.log
 exit 1
fi

date_output=$(date)
echo "$date_output stoped $docker_output" >> /var/log/dockup/docker.log

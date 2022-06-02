#!/bin/bash
subdomain=$1
domain=$2
fulldom=$subdomain.$domain
prefix='root_site-'
sufix='_1'

docker_output=$(docker start $prefix$fulldom$sufix)

if [[ $? -ne 0 ]]
then
 domainurl=$subdomain.$domain
 error=$(echo "error in step one")
 date_output=$(date)
 echo "$date_output started $domainurl $error" >> /var/log/dockup/docker.log
 exit 1
fi

date_output=$(date)
echo "$date_output started $docker_output" >> /var/log/dockup/docker.log

#!/bin/bash
subdomain=$1
domain=$2
fulldom=$subdomain.$domain
prefix='root_site-'
sufix='_1'


stop_output=$(docker stop $prefix$fulldom$sufix)

if [[ $? -ne 0 ]]
then
 error=$(echo "error in step one")
 date_output=$(date)
 echo "$date_output deleted $stop_output $error" >> /var/log/dockup/docker.log
 exit 1
fi

delete_output=$(docker rm $prefix$fulldom$sufix)

if [[ $? -ne 0 ]]
then
 error=$(echo "error in step two")
 date_output=$(date)
 echo "$date_output deleted $stop_output $error" >> /var/log/dockup/docker.log
 exit 1
fi

rm -r /usr/dockup/mountpoint/$subdomain

date_output=$(date)
echo "$date_output deleted $delete_output" >> /var/log/dockup/docker.log

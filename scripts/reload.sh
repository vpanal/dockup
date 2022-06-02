subdomain=$1;
domain=$subdomain.$2;
url=$3;
pull_output=$(echo 'git pull '$url' /usr/dockup/mountpoint/'$subdomain)
cd /usr/dockup/mountpoint/$subdomain/
git=$(git pull)

if [[ $? -ne 0 ]]
then
 error=$(echo "error in step one")
 date_output=$(date)
 echo "$date_output reloaded $domain $error" >> /var/log/dockup/docker.log
 exit 1
fi

date_output=$(date)
echo "$date_output reloaded $domain $git" >> /var/log/dockup/docker.log

#!/bin/sh
control=$1
action=$2
date=$(date +%Y%m%d)
logpath=/Users/peiwei/code/my_project/Public/script/${control}/
if [ ! -d $logpath ];then
mkdir $logpath
fi

/usr/local/opt/php\@5.6/bin/php /Users/peiwei/code/my_project/index.php ${control}/${action} -a 345  >> ${logpath}${action}-${date}.log 2>&1

#!/bin/sh

apache_log='/var/log/httpd/access_log'
logdays=3
LANG=C

#get today log lines
regexp=`date +%d\\\/%b\\\/%Y` # example 14\/Apr\/2009
today=`echo $regexp | sed 's;\\\/;-;g'` # example 14-Apr-2009
awk "/${regexp}/" $apache_log > ~/apache_${today}.log
echo "Backup : $today log"

#delete old logs(over 3 days ago)
if [ $logdays -ge `ls apache_*.log|wc -l` ]
then
  exit
else
  threedaysago=`date +%d-%b-%Y --date "$logdays days ago"`
  rm -f ~/apache_${threedaysago}.log
  echo "Delete old log :$threedaysago"
fi


#!/bin/bash
ProcNumber=`ps -ef | grep 'kaog_bot.php' | grep -v 'grep' | wc -l`
if [ $ProcNumber -eq 0 ];then
    php /home/eykwwide/public_html/cronjob/kaog_bot/kaog_bot.php &
fi;
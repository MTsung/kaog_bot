#!/bin/bash
ProcNumber=`ps -ef | grep 'kaog_bot.php' | grep -v 'grep' | wc -l`
if [ $ProcNumber -eq 0 ];then
    php /home/eykwwide/test_/kaog_bot.php &
fi;
#!/bin/bash
# 定时采集任务

curl "http://127.0.0.1/api.php/timming/index.html?enforce=1&name=hongniu" >> /home/wwwroot/www.feimaoyingshi.com/task/log/hn.txt; 
curl "http://127.0.0.1/api.php/timming/index.html?enforce=1&name=wujin" >> /home/wwwroot/www.feimaoyingshi.com/task/log/wujin.txt;
curl "http://127.0.0.1/api.php/timming/index.html?enforce=1&name=uku" >> /home/wwwroot/www.feimaoyingshi.com/task/log/uk.txt;
curl "http://127.0.0.1/api.php/timming/index.html?enforce=1&name=shandian" >> /home/wwwroot/www.feimaoyingshi.com/task/log/sd.txt;

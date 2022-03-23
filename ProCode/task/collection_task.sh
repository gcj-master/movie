#!/bin/bash
# 定时采集任务

curl "http://www.feimaoyingshi.com/api.php/timming/index.html?enforce=1&name=wujin" >> /home/wwwroot/www.feimaoyingshi.com/task/log/hn.txt; 

#!/bin/bash
# 数据库备份任务 需要安装 yum install expect

#脚本存放目录
BackupDir=/home/product_backup/databases
#数据库库名
DataBaseName=feimaoys
#日期命名
DateTag=`date +%Y%m%d`
#sql脚本名字
sqltag=$DataBaseName'_'$DateTag'.'sql
#压缩文件名字
tartag=$sqltag'.'tar'.'gz
#目标服务器
targetServer=149.28.22.163
#目标服务器路径
targetServerPath=/home/product_backup/databases/
#备份
mysqldump -uroot -pGcj13521gcj# --databases $DataBaseName > $BackupDir/$sqltag 
#进行压缩并删除原文件
cd $BackupDir
echo "开始压缩";
tar -czf  $tartag $sqltag
rm -rf $sqltag
echo "压缩成功";
echo "开始发送";
# 发送文件到备份服务器上
scp $tartag root@$targetServer:$targetServerPath
#定时清除文件，以访长期堆积占用磁盘空间(删除5天以前带有tar.gz文件)
find $BackupDir -mtime +5 -name '*.tar.gz' -exec rm -rf {} \;
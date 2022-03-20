#!/bin/bash
# 数据库备份任务 需要安装 yum install expect
#upload目录
UploadDir=/home/wwwroot/www.feimaoyingshi.com
#压缩包存放目录
BackupDir=/home/product_backup/uploads
#日期命名
DateTag=`date +%Y%m%d`
#压缩文件名字
tartag='upload_'$DateTag'.'tar'.'gz
#目标服务器
targetServer=149.28.22.163
#目标服务器路径
targetServerPath=/home/product_backup/uploads/
#进行压缩
cd $UploadDir
echo "开始压缩";
tar -czf $BackupDir/$tartag ./upload
echo "压缩成功";
echo "开始发送";
# 发送文件到备份服务器上
scp $BackupDir/$tartag root@$targetServer:$targetServerPath
echo "发送完成"
#定时清除文件，以访长期堆积占用磁盘空间(删除5天以前带有tar.gz文件)
find $BackupDir -mtime +5 -name '*.tar.gz' -exec rm -rf {} \;
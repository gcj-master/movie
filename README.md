## uat(vultr)    
ip：149.28.22.163 
root === A9U)oP]SXktA=(jWoAbA
## 部署说明
1. 使用系统 centos7.6
2. 使用lnmp继承环境 https://lnmp.org/install.html    
   先安装 yum install screen  
   上传lnmp1.8的压缩包 到/root  (http://175.6.32.4:88/soft/lnmp/lnmp1.8-full.tar.gz)
   上传静态文件 maccms.conf 到 /usr/local/nginx/conf/rewrite  
   运行：screen -S lnmp    
    tar zxf lnmp1.8-full.tar.gz && cd lnmp1.8-full && ./install.sh lnmp 

3.  创建网站  https://lnmp.org/faq/lnmp-vhost-add-howto.html  
    lnmp vhost add  
    www.feimaoyingshi.com   
    启用伪静态 maccms    
    启用pathinfo    
    数据库名/用户名：feimaoys    
    密码：Feimaoys#123    

4. 上传maccms-10源代码    
    修改源代码权限    
    chmod 777 ./runtime -R && chmod 777 ./upload -R && chmod 777 ./application -R && chmod 777 ./static -R && chmod 777 ./template -R

5. 后台管理员账号 alan == gcj13521gcj    
6. 修改admin.php目录 fsadmin.php (生产环境可复杂些)
7. 上传模板文件 myTheme  并 修改模板文件权限
8. 修改maccms代码    
    application\extra\maccms.php    
    application\extra\quickmenu.php    
9. 在my.conf里找到sql-mode=”STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION”
把其中的STRICT_TRANS_TABLES,去掉,或者把sqlmode=STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION
注释掉，然后重启mysql就ok了

## 添加定时任务
1. 现在后台管理系统，定时任务配置采集任务
2. 在linux系统添加定时任务    
3. 需要安装 yum install expect
4. 需要在生产服务器往备份服务器发送一次文件，添加ssh缓存
查看任务 crontab -e
//采集任务每天6点 12点 22点
00 6 * * * /bin/bash /home/wwwroot/www.feimaoyingshi.com/task/collection_task.sh   
00 12 * * * /bin/bash /home/wwwroot/www.feimaoyingshi.com/task/collection_task.sh   
00 22 * * * /bin/bash /home/wwwroot/www.feimaoyingshi.com/task/collection_task.sh   
//数据库备份任务每天凌晨1点执行
00 1 * * * /bin/bash /home/wwwroot/www.feimaoyingshi.com/task/data_backup.sh
//图片备份任务每周二、四、六凌晨2点执行
00 2 * * 2,4,6 /bin/bash /home/wwwroot/www.feimaoyingshi.com/task/upload_backup.sh   

 常用命令：    
 crontab –l : 显示 crontab 任务    
 crontab -r : 删除 crontab 任务    
 systemctl status crond //查看crontab状态
 参考 https://www.cnblogs.com/wucaiyun1/p/6866730.html    

 ## 禁止IP访问    
https://developer.aliyun.com/article/548497

## 关于移动端手机横屏手机
1. 默认使用m38u的资源，m38u资源可以使用本地播放器，添加播放器的方法 https://www.mytheme.cn/article/363.html, 默认使用DPlayer-H5播放器。关于手机不能横屏的解决方法 https://github.com/DIYgod/DPlayer/issues/429    
```javascript
//手机全屏自动横屏
var isMobile = !!navigator.userAgent.match(/AppleWebKit.*Mobile.*/);
if (isMobile) {
    //全屏事件
    dp.on('fullscreen',function() {
        screen.orientation.lock("landscape");
    });
    //退出全屏事件
    dp.on('fullscreen_cancel',function() {
        screen.orientation.unlock();
    });
}
```





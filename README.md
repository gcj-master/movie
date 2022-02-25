## uat(vultr)    
ip：149.28.22.163 
root === A9U)oAP]SXAktA=(jWoAb  [qu A]

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


## 未完成事项
1. 手机端横屏播放
2. 网站Logo PC和移动端  网站图标ico
3. 广告投放测试

## 其他事项
1. 统计代码使用 统计 https://analytics.google.com




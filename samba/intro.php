<?php

/**
     安装 samba 服务
     yum -y install samba

     如果有错误 查看是否挂载源
     ls /mnt/cdrom
     mount /dev/sr0 /mnt/cdrom

     添加用户
   * id peng #查看用户
   * useradd peng
   * passwd peng
   *
   * 添加 smb 用户
   * smbpasswd -a peng
   * 输入密码
   * 
   * pdbedit -L #查看
   * vim /etc/samba/smb.conf
   *
   * nginx 中项目指定目录 /home/wwwroot/default
   *
   * [www]
   *   path = /home/wwwroot/default
   *   valid users =peng
   *   writable = yes
   * :wq
   * testparm #查看 samba 是否正确
   * 启动samba 
   * service smb start
   *
   * 注意网络防火墙设置
   * 为samba 用户 peng 设置 acl 权限
   * setfacl -R -m u:peng:rwx /home/wwwroot/default
   * setfacl -R -m d:u:peng:rwx /home/wwwroot/default
*/
<?php

/**
    [root@localhost ~]#
    root 当前登录用户
    localhost 主机名
    ~ 当前所在目录 (家目录)
    # 超级用户的提示符
    $ 普通用户的提示符

    命令 [选项] [参数]
    注意 个别命令使用不遵循此格式
         当有多个选项时 可以写在一起
         简化选项与完整选项
         -a 等于 -all

    ls [选项][文件或目录]
    选项
         -a 显示所有文件 包括隐藏文件
         -l 显示详细信息
         -d 查看目录属性
         -h 人性化显示文件大小
         -i 显示 inode

    -rw-r--r--
    - 文件类型 (- 文件 d 目录 l 软链接)
    rw- u所有者 
    r-- g所属组
    r-- o其他人

    r 读 4 w 写 2 x 执行 1 
    文件类型有七种 文件 目录 软链接 块设备文件 字符设备文件 套接字文件和管道文件

    目录相关命令
    建立目录
    mkdir -p [目录名]
    -p 递归创建
    命令英文原意 make directories
    mkdir -p apeng/peng (mkdir apeng cd ./apeng mkdir peng)

    切换所在目录 cd
    cd [目录]
    命令英文原意 change directory
    简化操作
    cd ~  进入当前用户的家目录
    cd 
    cd -  进入上次目录
    cd .. 进入上一级目录
    cd .  进入当前目录

    ctrl + l 进行清屏

    相对路径 参照当前所在目录 进行查找
    [root@imooc ~]# cd ../usr/local/src/

    绝对路径 从根目录开始指定 一级一级递归查找 在任何目录下 都能进入指定位置
    [root@imooc ~]# cd /etc/

    查询所在目录位置 pwd
    命令英文原意 print working directory

    删除空目录 rmdir
    rmdir [目录名]
    命令英文原意 remove empty directories

    删除文件或目录 rm
    rm -rf [文件或目录]
    命令英文原意 remove
    选项
         -r 删除目录
         -f 强制

    复制命令 cp
    cp [选项] [原文件或目录] [目标目录]
    命令英文原意 copy
    选项
         -r 复制目录
         -p 连带文件属性复制
         -d 若源文件是链接文件 则复制链接属性
         -a 相当于 -pdr
         cp -a yii2 test

    mv [原文件或目录] [目标目录]
    命令英文原意 move

    常用目录的作用
    /根目录
    /bin 命令保存目录 (普通用户就可以读取的命令)
    /boot 启动目录 启动相关文件
    /dev 设备文件保存目录
    /etc 配置文件保存目录
    /home 普通用户的家目录
    /lib 系统库保存目录
    /mnt 系统挂载目录
    /media 挂载目录

    /root 超级用户的家目录
    /tmp 临时目录
    /sbin 命令保存目录 (超级用户才能使用的目录)
    /proc 直接写入内存的
    /sys
    /usr 系统软件资源目录
         /usr/bin/系统命令 (普通用户)
         /usr/sbin/系统命令 (超级用户)
    /var 系统相关文档内容

    根目录下的 bin 和sbin usr 目录下的 bin 和 sbin 这四个目录都是用来保存系统命令的

    proc sys 目录不能直接操作 这两个目录保存的是内存的过载点

    链接命令 ln
    ln -s [原文件] [目标文件]
    命令英文原意 link
    功能描述 生成链接文件
    选项 -s 创建软链接

    硬链接特征
    拥有相同的 i 节点和存储 block 块 可以看做是同一个文件
    可通过 i 节点识别
    不能跨分区
    不能针对目录使用

    软链接特征
    类似 windows 快捷方式
    软链接拥有自己的 i 节点和 block 块 但是数据块中只保存原文件的文件名和 i 节点号 并没有实际的文件数据
    lrwxrwxrwx l 软链接 (软链接文件权限都为 rwxrwxrwx)
    修改任意文件 另一个都改变
    删除原文件 软链接不能使用

    echo 1111 >> /root/cangls
    cat /tmp/cangls.soft
    cat /tmp/cangls.hard
    echo 2222 >> /tmp/cangls.soft
    cat /tmp/cangls/hard
    cat /root/cangls
    echo 3333 >> /tmp/cangls.hard
    cat /root/cangls
    cat /tmp/cangls.soft
    rm -rf /root/cangls
    ll /tmp
    touch csb
    ls
    ln -s /root/csb /tmp/
    touch sb
    ln -s sb /tmp
    ll /tmp

    文件搜索命令 locate
    命令搜索命令 whereis 与 which
    文件搜索命令 find
    字符串搜索命令 grep
    find 命令与 grep 命令的区别

    locate 文件名
    在后台数据库中按文件名搜索 搜索速度更快
    touch /tmp/cangls
    updatedb
    locate cangls 只

    /var/lib/mlocate
    #locate 命令所搜索的后台数据库

    updatedb 更新数据库
    /etc/updatedb.conf 配置文件
    PRUNE_BIND_MOUNTS = "yes"
    #开启搜索限制
    PRUNEFS = 
    #搜索时 不搜索的文件系统
    PRUNENAMES =
    #搜索时 不搜索的文件类型
    PRUNEPATHS =
    #搜索时 不搜索的路径

    which pwd
    whereis cd
    which cd

    echo $PATH (用冒号分隔)
    PATH 环境变量 定义的是系统搜索命令的路径
    [root@localhost ~]# echo $PATH
    /usr/lib/qt-3.3/bin:...

    find [搜索范围] [搜索条件]
    #搜索文件
    find / -name install.log #阿里云服务器上是搜索不到文件的
    find / -name lnmp-install.log
    /root/lnmp-install.log
    #避免大范围搜索 会非常耗费系统资源
    #find是在系统当中搜索符合条件的文件名 如果需要匹配 使用通配符匹配 通配符是完全匹配

    * 匹配任意内容
    ? 匹配任意一个字符
    [] 匹配任意一个中括号内的字符

    find /root -iname install.log #不区分大小写
    find /root -user root #按照所有者搜索
    find /root -nouser #查找没有所有者的文件
    find /var/log/ -mtime +10 #查找10天前修改的文件
    -10 10 天内修改文件
    10  10天当天修改的文件
    +10 10天前修改的文件

    atime 文件访问时间
    ctime 改变文件属性
    mtime 修改文件内容

    find . -size 25k #查找文件大小是 25KB 的文件
    -25K 小于 25KB 的文件
    25K  等于 25KB 的文件
    +25K 大于 25KB 的文件
    find . -inum 262422 #查找 i 节点是 262422 的文件

    find /etc -size +20k -a -size -50k #查找/etc/目录下 大于 20KB 并且小于 50KB 的文件
    -a and 逻辑与 两个条件都满足
    -o or  逻辑或 两个条件满足一个即可
    find /etc -size +20k -a -size -50k -exec ls -lh {} \; #查找 /etc/ 目录下 大于 20KB 并且小于 50KB 的文件 并显示详细信息
    #-exec/-ok 命令 {} \; 对搜索结果执行操作

    搜索字符串命令 grep
    grep [选项] 字符串 文件名 #在文件当中匹配符合条件的字符串
    -i 忽略大小写
    -v 排除指定字符串

    find 命令与 grep 命令的区别
    find 命令 在系统当中搜索符合条件的文件名 如果需要匹配 使用通配符匹配 通配符是完全匹配
    grep 命令 在文件当中搜索符合条件的字符串 如果需要匹配 使用正则表达式进行匹配 正则表达式时包含匹配

    帮助命令 man
    man 命令 #获取指定命令的帮助
    man ls   #查看 ls 的帮助

    查看命令拥有那个级别的帮助
    man -f 命令 相当于 whatis 命令
    man -5 passwd
    man -4 null
    man -8 ifconfig
    man 的级别
    1 查看命令的帮助
    2 查看可被内核调用的函数的帮助
    3 查看函数和函数库的帮助
    4 查看特殊文件的帮助 (主要是 /dev 目录下的文件)
    5 查看配置文件的帮助
    6 查看游戏的帮助
    7 查看其它杂项的帮助
    8 查看系统管理员可用命令的帮助
    9 查看和内核相关文件的帮助

    shell 内部命令帮助
    help shell 内部命令 #获取 shell 内部命令的帮助

    whereis cd #确定是否是 shell 内部命令
    help cd #获取内部命令帮助

    详细命令帮助 info
    info 命令 #进入子帮助页面 (带有 * 号标记)
    u 进入上层页面
    n 进入下一个帮助小节
    p 进入上一个帮助小节
    q 退出

    压缩命令
    常用压缩格式 .zip .gz .bz2
    常用压缩格式 .tar.gz .tar.bz2

    .zip 格式压缩
    zip 压缩文件名 源文件 #压缩文件
    zip -r 压缩文件名 源目录 #压缩目录

    .gz 格式压缩
    gzip 源文件 #压缩为 .gz 格式的压缩文件 源文件会消失
    gzip -c 源文件 > 压缩文件 #压缩为 .gz 格式 源文件保留
    gzip -c cangls > cangls.gz
    gzip -r 目录 #压缩目录下所有的子文件 但是不能压缩目录

    bzip2 源文件 #压缩为 .bz2 格式 不保留源文件
    bzip2 -k 源文件 #压缩之后保留源文件
    注意 bzip2 命令不能压缩目录
    bzip2 -d 压缩文件 #解压缩 -k 保留压缩文件
    bunzip2 压缩文件 #解压缩 -k 保留压缩文件

    打包命令 tar
    tar -cvf 打包文件名 源文件
    -c 打包
    -v 显示过程
    -f 指定打包后的文件名
    tar -cvf longzls.tar longzls

    tar -xvf 打包文件名
    -x 解打包
    tar -xvf longzls.tar
*/
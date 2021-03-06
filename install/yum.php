<?php

/**
    yum 在线安装
    好处 将所有软件包放到官方服务器上 当进行 yum 在线安装时 可以自动解决依赖性问题
    redhat 的 yum 在线安装是需要付费的

    yum 源文件
    cd /etc/yum.repos.d/
    ls
    vi /etc/yum.repos.d/CentOS-Base.repo
    [base] 容器名称 一定要放在 [] 中
    name 容器说明 可以自己随便写
    mirrorlist 镜像站点 这个可以注释掉
    baseurl 我们的 yum 源服务器的地址 默认是CentOs 官方的 yum 源服务器 是可以使用的 如果你觉得慢可以改成你喜欢的 yum 源地址
    enabled 此容器是否生效果 如果不写或写成 enable=1 都是生效 写成 enable=0 就是不生效
    gpgcheck 如果是 1 是指 RPM 的数字证书生效 如果是 0 则不生效
    gpgkey 数字证书的公钥文件保存位置 不用修改

    如果没有网络 如何使用 yum 源
    挂载光盘
    mkdir /mnt/cdrom #建立挂载点
    mount /dev/cdrom /mnt/cdrom/ #挂载光盘

    使网络yum 源失效
    cd /etc/yum.repos.d/ #进入 yum 源目录
    mv CentOS-Base.repo CentOS-Base.repo.bak #修改 yum 源文件后缀名 使其失效
    vim CentOS-Media.repo
    name=CentOS-$releasever - Media
    baseurl=file:///mnt/cdrom #地址为你自己的光盘挂载地址
            file:///media/cdrom
            file:///media/cdrecorder/ #注释这两个不存在的地址
    gpgcheck=1
    enabled=1 #把enabled=0 改为enabled=1 让这个 yum 源配置文件生效
    gpgkey=file:///etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-6

    常用 yum 命令
    查询 
    yum list #查询所有可用软件包列表
    yum search 关键字 #搜索服务器上所有和关键字相关的包

    安装
    yum -y install 包名
    install 安装
    -y 自动回答 yes
    yum -y install gcc

    升级
    yum -y update 包名
    update 升级
    -y 自动回答 yes
    yum -y update 升级所有的内容 (不建议使用)
    yum -y update httpd 升级 httpd

    卸载
    yum -y remove 包名
    remove 卸载
    -y 自动回答 yes
    服务器使用最小化安装 用什么软件安装什么 尽量不卸载

    YUM 软件组管理命令
    yum grouplist #列出所有可用的软件组列表
    yum groupinstall 软件组名 #安装指定软件组 组名可以由 grouplist 查询出来
    yum groupremove 软件组名 #卸载指定软件组

*/
<?php

/**
*   Linux 配置 IP 地址的方法
    
    ifconfig 命令临时配置IP 地址
    setup 工具永久配置IP 地址
    修改网络配置文件
    图形界面配置IP 地址

    ifconfig 命令
    ifconfig 命令 查看与配置网络状态命令
    windows 上使用 ipconfig

eth0 #第一个网卡      Link encap:Ethernet #网络类型 HWaddr 00:0C:29:B1:44:43 #MAC 地址
          inet addr:192.168.60.100 #IP 地址  Bcast:192.168.60.255 #广播地址  Mask:255.255.255.0 #子网掩码
          inet6 addr: fe80::20c:29ff:feb1:4443/64 Scope:Link #IP V6
          UP BROADCAST RUNNING MULTICAST  MTU:1500  Metric:1
          RX packets:2038 #当前接收的数据包 errors:0 dropped:0 overruns:0 frame:0
          TX packets:315 #当前发送的数据包 errors:0 dropped:0 overruns:0 carrier:0
          collisions:0 txqueuelen:1000
          RX bytes:191360 (186.8 KiB) #接收数据包的总大小  TX bytes:74407 (72.6 KiB) #发送数据包的总大小
          Interrupt:19 Base address:0x2000 #网卡在内存中的地址


    ifconfig eth0 192.168.0.200 netmask 255.255.255.0
    临时设置 eth0 网卡的 IP 地址与子网掩码

    很少使用 ifconfig 来临时设置 IP 常使用 setup 设置 IP 地址
    视图界面不支持中文字符 需要安装 zhcon 等中文插件

    setup ---> 防火墙配置 网络配置 系统服务 验证配置
    防火墙配置 (启用 关闭)
    网络配置 ---> DNS 配置  设备配置
    DNS 配置 ---> 主机名
                  主 DNS
                  第二 DNS
                  第三 DNS
                  DNS 搜寻路径

    设备配置 ---> eth0 ---> 名称
                       ---> 设备
                       使用 DHCP
                       静态 IP
                       子网掩码
                       默认网关 IP
                       主 DNS 服务器
                       第二 DNS 服务器


    使用配置文件配置ip (只有红帽有setup 命令) 配置文件有三个
    网卡信息文件
    vi /etc/sysconfig/network-scripts/ifcfg-eth0 #查看配置文件
    DEVICE=eth0 #网卡设备名
    BOOTPROTO=none #是否自动获取IP (none, static, dhcp)
    HWADDR=00:0c:29:17:c4:09 #MAC地址
    NM_CONTROLLED=yes #是否可以由 Network Manager 图形管理工具托管
    ONBOOT=yes #是否随网络服务启动 eth0生效
    TYPE=Ethernet #类型为以太网
    UUID="44..." #唯一识别码
    IPADDR=192.168.0.252 #IP地址
    NETMASK=255.255.255.0 #子网掩码
    GATEWAY=192.168.0.1 #网关
    DNS1=202.106.0.20 #DNS
    IPV6INIT=no #IPv6没有启用
    USERCTL=no #不允许非root 用户控制此网卡

    主机名文件
    vi /etc/sysconfig/network
    NETWORKING=yes
    HOSTNAME=localhost.localdomain
    hostname abc #临时修改目录
    hostname #查看当前主机名

    DNS 配置文件
    vi /etc/resolv.conf
    nameserver 202.106.0.20 #名称服务器
    search localhost

    虚拟机网络参数配置
    setup #修改并配置IP 地址

    启动网卡
    vi /etc/sysconfig/network-scripts/ifcfg-eth0
    把 ONBOOT=no
    改为 ONBOOT=yes
    service network restart #重启网络服务

    修改 UUID
    vi /etc/sysconfig/network-scripts/ifcfg-eth0
    #删除 MAC 地址行
    rm -rf /etc/udev/rules.d/70-persistent-net.rules
    #删除网卡和 MAC 地址绑定文件
    重新启动系统

    网络连接
    桥接 虚拟机与真实机之间使用真实网卡来通信 (可访问外网)
    NAT 虚拟机与真实机之间使用 vm8 虚拟网卡来通信 (不能与内网主机通信 但可访问外网)
    Host-only 虚拟机与真实机之间使用 vm1 虚拟网卡来通信 (只能与真实机通信 不能与内网主机通信)
*/
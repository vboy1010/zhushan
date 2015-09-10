**Requirement**

**svn 服务器搭建**

    yum install subversion
    mkdir -p /data/svn
    svnadmin create test //创建一个项目

此时，会产生一系列目录和文件

    drwxr-xr-x. 2 root root 4096 Sep 10 00:40 conf
    drwxr-sr-x. 6 root root 4096 Sep 10 01:03 db
    -r--r--r--. 1 root root    2 Sep 10 00:00 format
    drwxr-xr-x. 2 root root 4096 Sep 10 00:00 hooks
    drwxr-xr-x. 2 root root 4096 Sep 10 00:00 locks
    -rw-r--r--. 1 root root  229 Sep 10 00:00 README.txt

进入 `conf` 目录，有三个文件

    -rw-r--r--. 1 root root 1155 Sep 10 00:31 authz
    -rw-r--r--. 1 root root  322 Sep 10 00:06 passwd
    -rw-r--r--. 1 root root 2284 Sep 10 00:40 svnserve.conf

编辑 `authz`

    [groups]
    admin = your-username,other-username //创建一个组admin，组员自定义

    [/]
    @admin = rw //根目录下，admin组读写权限

    [repository:/test] //test项目下，admin组读写权限
    @admin = rw
    |* = r //任意用户都有读权限.   |（要去掉，编辑器语法冲突了，故加一个|）。

编辑 `passwd`

    [users]
    your-username = your-password
    other-username = other-password

编辑 `svnserve.conf`

    anon-access = none
    auth-access = write
    password-db = passwd
    authz-db = authz

**注意**：所有的配置项，每行的`最前面`都不能有`空格`，不然会`报错`

启动 `svn`

    svnserve -d -r /data/svn //启动svn    

检出 `test` 项目

    svn checkout svn://your-server-ip/test

**filterdiff** 命令

各系统版本的下载地址：http://rpmfind.net/linux/rpm2html/search.php?query=patchutils

    wget ftp://rpmfind.net/linux/centos/6.7/os/i386/Packages/patchutils-0.3.1-3.1.el6.i686.rpm
    rpm -ivh patchutils-0.3.1-3.1.el6.i686.rpm
    
安装完成后，就可以使用 `filterdiff` 命令了。

    svn diff -r BASE:HEAD /home/open/www/publish/svn/test/index.php | filterdiff
    --- /home/open/www/publish/svn/test/index.php   (working copy)
    +++ /home/open/www/publish/svn/test/index.php   (revision 3)
    @@ -1,3 +1,2 @@
     <?php
    -echo 111;
    -echo 222;
    +echo 111111;
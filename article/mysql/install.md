**CentOS版本**

    cat /etc/redhat-release
    >> CentOS release 5.4 (Final)

**系统内核**

    uname -a
    >> Linux test33x.ops.xxx.net 2.6.18-164.el5xen #1 SMP Thu Sep 3 04:03:03 EDT 2009 x86_64 x86_64 x86_64 GNU/Linux

**MYSQL下载**

    下载页面
    
    Select Platform
    >> Red Hat Enterprise Linux / Oracle Linux
    
    选择x86_64版本
    
    MySQL-client-5.5.38-1.rhel5.x86_64.rpm
    MySQL-server-5.5.38-1.rhel5.x86_64.rpm
    MySQL-shared-5.5.38-1.rhel5.x86_64.rpm

**卸载旧版本**

    yum remove mysql mysql-server mysql-libs
    rm -rf /var/lib/mysql
    rm /etc/my.cnf

    rpm -qa|grep mysql //查看是否安装了mysql数据库
    >> rpm -e mysql --nodeps

**MYSQL安装**

    rpm -ivh MySQL-client-5.5.38-1.rhel5.x86_64.rpm
    rpm -ivh MySQL-server-5.5.38-1.rhel5.x86_64.rpm
    rpm -ivh MySQL-shared-5.5.38-1.rhel5.x86_64.rpm
    
**配置**

    【执行命令】 /usr/bin/mysql_secure_installation
    
    NOTE: RUNNING ALL PARTS OF THIS SCRIPT IS RECOMMENDED FOR ALL MySQL
    SERVERS IN PRODUCTION USE!  PLEASE READ EACH STEP CAREFULLY!
    In order to log into MySQL to secure it, we'll need the current
    password for the root user.  If you've just installed MySQL, and
    you haven't set the root password yet, the password will be blank,
    so you should just press enter here.
    
    Enter current password for root (enter for none):
    OK, successfully used password, moving on...

    Setting the root password ensures that nobody can log into the MySQL
    root user without the proper authorisation.
    You already have a root password set, so you can safely answer 'n'.
    Change the root password? [Y/n] Y
    New password:
    Re-enter new password:
    Password updated successfully!
    Reloading privilege tables..
    ... Success!
    By default, a MySQL installation has an anonymous user, allowing anyone
    to log into MySQL without having to have a user account created for
    them.  This is intended only for testing, and to make the installation
    go a bit smoother.  You should remove them before moving into a
    production environment.
    Remove anonymous users? [Y/n] Y
    ... Success!
    Normally, root should only be allowed to connect from 'localhost'.  This
    ensures that someone cannot guess at the root password from the network.
    Disallow root login remotely? [Y/n] Y
    ... Success!
    By default, MySQL comes with a database named 'test' that anyone can
    access.  This is also intended only for testing, and should be removed
    before moving into a production environment.
    Remove test database and access to it? [Y/n] Y
    - Dropping test database...
    ... Success!
    - Removing privileges on test database...
    ... Success!
    Reloading the privilege tables will ensure that all changes made so far
    will take effect immediately.
    Reload privilege tables now? [Y/n] Y
    ... Success!
    Cleaning up...
    All done!  If you've completed all of the above steps, your MySQL
    installation should now be secure.
    Thanks for using MySQL!

**启动MYSQL**
    
    service mysql start
    
    >> Starting MySQL.                                            [确定]

    service mysql status

    >> MySQL running (32239)                                      [确定]

    service mysql stop

    >> Shutting down MySQL.                                       [确定]

**查看服务**

    chkconfig --list | grep mysql
    
    >> mysql            0:关闭    1:关闭    2:启用    3:启用    4:启用    5:启用    6:关闭

    chkconfig mysql on  //设置开机自启动



**查看版本**

    mysql -V
    
    >> mysql  Ver 14.14 Distrib 5.5.38, for Linux (x86_64) using readline 5.1

**连接MYSQL**

    mysql -u root -p

    Enter password: 
    Welcome to the MySQL monitor.  Commands end with ; or \g.
    Your MySQL connection id is 1
    Server version: 5.5.38 MySQL Community Server (GPL)
    
    Copyright (c) 2000, 2014, Oracle and/or its affiliates. All rights reserved.

    Oracle is a registered trademark of Oracle Corporation and/or its
    affiliates. Other names may be trademarks of their respective
    owners.

    Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

    mysql> 

安装配置完成！
**Gearmand Usage**

**相关链接**

> 
http://gearman.org/
http://pecl.php.net/package/gearman


**系统版本**

    CentOS 2.6.32

**备注**

    可以先直接安装 Gearmand, 看缺什么再选择下面的进行安装！

**Install gcc**

    yum install gcc-c++

**安装boost**

    wget https://github.com/boostorg/build/archive/2014.10.tar.gz
    ./bootstrap.sh
    ./b2 install

**安装qperf**

    yum install gperf.x86_64

**安装libevent libevent-devel**

    yum -y install libevent libevent-devel

**安装libuuid**

    http://sourceforge.net/projects/libuuid/files/latest/download
    wget http://downloads.sourceforge.net/project/libuuid/libuuid-1.0.3.tar.gz
    tar zxvf libuuid-1.0.3.tar.gz
    ./configure 
    make & make install

**安装Gearmand**

    wget https://launchpad.net/gearmand/1.2/1.1.11/+download/gearmand-1.1.11.tar.gz
    tar zxvf gearmand-1.1.11.tar.gz
    cd gearmand-1.1.11
    ./configure
    make & make install

**安装gearman的PHP扩展**

    wget http://pecl.php.net/get/gearman-1.1.2.tgz
    phpize
    ./configure
    make & make install
    
**启动 Job Server**

    gearmand -d
    
    [root@localhost www]# ps -ef | grep gearmand
    root     19109     1  0 01:06 ?        00:00:00 /usr/local/sbin/gearmand -d
    root     22185  3160  0 03:19 pts/1    00:00:00 grep gearmand

**命令行使用**

    [worker]
    [root@localhost www] gearman -w -f wc -- wc -l

    [client]
    [root@localhost www] gearman -f wc < /etc/passwd
    26

**PHP脚本使用**

[worker.php]

    <?php
    
    $worker = new GearmanWorker();
    $worker->addServer();
    $worker->addFunction("strtoupper", "my_func");
    
    while ($worker->work());
    
    function my_func($job)
    {
        return strtoupper($job->workload());
    }

[client.php]

<?php

    $client = new GearmanClient();
    $client->addServer();
    $string = $client->doNormal("strtoupper", "hello world");
    echo $string;

[执行]

    [root@localhost www]php worker.php

    [root@localhost www]php client.php
    HELLO WORLD
    
**Gearmand 使用 Mysql 作为队列存储**

[安装Mysql]

    yum install Mysql

[启动Gearmand]

    gearmand -d -q mysql --mysql-host=localhost --mysql-port=3306 --mysql-user=root \
    --mysql-password=123456 --mysql-db=test --mysql-table=gearman_queue

[查看数据表]

    mysql> show tables;
    +-------------------+
    | Tables_in_gearman |
    +-------------------+
    | gearman_queue     |
    +-------------------+
    1 row in set (0.00 sec)

[测试]

    #addTask: gearman -f testqueue -b xx00

    mysql> select * from gearman_queue;
    +--------------------------------------+---------------+----------+------+-------------+
    | unique_key                           | function_name | priority | data | when_to_run |
    +--------------------------------------+---------------+----------+------+-------------+
    | 75f18bac-2f95-11e5-87c3-cb400fa24a6b | testqueue     |        1 | xx00 |           0 |
    +--------------------------------------+---------------+----------+------+-------------+
    1 row in set (0.00 sec)

    #doJob：gearman -f testqueue -w
    
    mysql> select * from gearman_queue;
    Empty set (0.00 sec)

Done！
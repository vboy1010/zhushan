**Redis**

高性能的 Key/value 数据库。

**安装**

    wget http://download.redis.io/redis-stable.tar.gz
    tar xvzf redis-stable.tar.gz -C /usr/local/redis
    cd /usr/local/redis
    make

进入`src`目录

    cp redis-server /usr/local/bin/
    cp redis-cli /usr/local/bin/ 

> redis-server：   Redis服务器的daemon 启动程序。
> redis-cli：      Redis命令行操作工具。
> redis-benchmark：性能测试工具，测试Redis在你的系统和配置下的读、写性能。

**配置**

编辑文件 `redis.conf`

    daemonize：是否以后台daemon方式运行 //建议修改为yes

    pidfile：pid文件位置

    port：监听的端口号

    timeout：请求超时时间

    loglevel：log信息级别

    logfile：log文件位置

    databases：开启数据库的数量

    save * *：保存快照的频率，第一个*表示多长时间，第三个*表示执行多少次写操作。在一定时间内执行一定数量的写操作时，自动保存快照。可设置多个条件。

    rdbcompression：是否使用压缩

    dbfilename：数据快照文件名（只是文件名，不包括目录）

    dir：数据快照的保存目录（这个是目录）

    appendonly：是否开启appendonlylog，开启的话每次写操作会记一条log，这会提高数据抗风险能力，但影响效率。

    appendfsync：appendonlylog如何同步到磁盘（三个选项，分别是每次写都强制调用fsync、每秒启用一次fsync、不调用fsync等待系统自己同步）

**运行**

    redis-server /usr/local/redis/redis.conf  //启动REDIS服务

    redis-cli ping

    >> PONG // 成功返回PONG

**多实例**

一台`Redis`服务器，分成`N`个节点，每个节点分配一个端口（如：`7000`，`7001`，`7002`...），默认端口是`6379`。

每个节点对应一个`Redis`配置文件，如： `redis7000.conf`、`redis7001.conf`、`redis7002.conf`、`redis7003.conf`。

    cp redis.conf redis7000.conf
    cp redis.conf redis7001.conf
    cp redis.conf redis7002.conf
    cp redis.conf redis7003.conf

对每个实例配置，进行修改：

    daemonize yes                   //run as a daemon
    
    pidfile /var/run/redis7000.pid  //进程pid
    
    port 7000           //端口号
    
    loglevel verbose    //记录等级，可选值为（debug、verbose、notice、warning）
    
    logfile stdout      //Specify the log file name
    
    dir /data/redis/    //redis数据的存储路径

对所有的实例做如上修改。

**启动多实例**

    redis-server /usr/local/redis/redis7000.conf
    redis-server /usr/local/redis/redis7001.conf
    redis-server /usr/local/redis/redis7002.conf
    redis-server /usr/local/redis/redis7003.conf

**主从配置**

`redis` 支持 `master-slave` 的主从配置。配置方法：在从机的配置文件中修改`slaveof` 参数为主机的 `ip` 和 `port` 即可。

**内存配置**

    echo 1 > /proc/sys/vm/overcommit_memory

> 指定了内核针对内存分配的策略，其值可以是`0`、`1`、`2`。
> `0`：表示内核将检查是否有足够的可用内存供应用进程使用；如果有足够的可用内存，内存申请允许；否则，内存申请失败，并把错误返回给应用进程
> `1`：表示内核允许分配所有的物理内存，而不管当前的内存状态如何
> `2`：表示内核允许分配超过所有物理内存和交换空间总和的内存

**数据存储**

`Redis` 的存储分为`内存存储`、`磁盘存储` 和 `log文件` 三部分。

> `save seconds updates`：在指定时间内，达到多少次更新操作时，就将数据同步到数据文件。这个可以多个条件配合，比如默认配置文件中的设置，就设置了三个条件。
> 
> `appendonly yes/no`：是否在每次更新操作后进行日志记录，如果不开启，可能会在断电时导致一段时间内的数据丢失。
>                    因为`Redis`本身同步数据文件是按上面的`save`条件来同步的，所以有的数据会在一段时间内只存在于内存中。
> 
> `appendfsync no/always/everysec：no`表示等操作系统进行数据缓存同步到磁盘，`always`表示每次更新操作后手动调用`fsync()`将数据写到磁盘，`everysec`表示每秒同步一次。

**相关软件**

    phpredis

    Webdis
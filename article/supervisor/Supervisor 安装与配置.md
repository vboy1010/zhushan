[**Supervisor**]

    http://supervisord.org/
    
[**Python**]

如果没有,自己去装吧,一般 linux 自带了.

[**easy_install**]

    [root@vm source]# wget https://bootstrap.pypa.io/ez_setup.py -O - | python

[**安装superviosr**]

    [root@vm source]# easy_install supervisor

[**状态**]

    [root@vm source]# python
    Python 2.6.6 (r266:84292, Jan 22 2014, 09:37:14) 
    [GCC 4.4.7 20120313 (Red Hat 4.4.7-4)] on linux2
    Type "help", "copyright", "credits" or "license" for more information.
    >>> import supervisor
    >>>

[**配置文件**]

    [root@vm source]# echo_supervisord_conf > /etc/supervisord.conf
    
[**监视一个程序**]

    ; The [include] section can just contain the "files" setting.  This
    ; setting can list multiple files (separated by whitespace or
    ; newlines).  It can also contain wildcards.  The filenames are
    ; interpreted as relative to this file.  Included files *cannot*
    ; include files themselves.
    
    [include] /**我是注释，一定要把前面的分号;去掉，不然不会开启include功能，太傻了**/
    files = /etc/supervisor/*.ini
    
在 `/etc/supervisor/` 目录下建立 `redis.ini` 文件

    [program:redis]
    command=/usr/bin/redis-server /usr/local/redis/redis.conf
    autorstart=true
    autorestart=true
    stdout_logfile=/tmp/supervisor.log
    
[**Web配置**]

    [inet_http_server]         ; inet (TCP) server disabled by default
    port=*:9001        ; (ip_address:port specifier, *:port for all iface)
    ;username=user              ; (default is no username (open server))
    ;password=123               ; (default is no password (open server))

如果配置了用户名和密码，就需要输入用户名和密码才能进入web界面。

[**启动supervisord**]

    [root@vm source]# supervisord
    
    可能会输出一堆信息出来
    
    /usr/lib/python2.6/site-packages/supervisor-3.1.3-py2.6.egg/supervisor/options.py:296: UserWarning: Supervisord is running as root and it is searching for its configuration file in default locations (including its current working directory); you probably want to specify a "-c" argument specifying an absolute path to a configuration file for improved security.
      'Supervisord is running as root and it is searching '
    /usr/lib/python2.6/site-packages/supervisor-3.1.3-py2.6.egg/supervisor/options.py:383: DeprecationWarning: Parameters to load are deprecated.  Call .resolve and .require separately.
      return pkg_resources.EntryPoint.parse("x="+spec).load(False)
      
不用管它
      
      [root@vm source]# ps -ef ｜grep supervisord
      root     20041     1  0 03:21 ?        00:00:00 /usr/bin/python /usr/bin/supervisord
      
      [root@vm source]# ps -ef| grep redis
      root     20074 20073  0 03:23 ?        00:00:00 /usr/bin/redis-server *:6379

有上述进程，就表明成功了。

[**WEB管理界面**]

![图片描述][1]


  [1]: /img/bVmU1m

[**命令行管理工具**]

    [root@vm source]# supervisorctl status
    redis                            RUNNING   pid 20074, uptime 0:13:25
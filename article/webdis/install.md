**Webdis** 

为 `Redis` 提供 `HTTP` 接口，使得通过 `HTTP` 即可直接操作 `Redis`，极高的提升了效率。

**官网**

http://webd.is/

**安装**

    git clone git://github.com/nicolasff/webdis.git
    cd webdis
    make
    ./webdis &

可以看出，`Webdis` 在安装运行上秉承了 `Redis` 的极简主义！

**配置 Nginx 反向代理**

使得请求可以直接被传送至 `Webdis` 

    location ~/GET/ {
        proxy_pass http://webdis;
    } 
    location ~/INFO {
        proxy_pass http://webdis; 
    }
    upstream webdis {
        server 127.0.0.1:7379;
    }

**测试**

在命令行模式下，输入：`curl -v http://127.0.0.1:7379/SET/aa/bb`

[root@localhost webdis]# curl -v http://127.0.0.1:7379/SET/aa/bb
* About to connect() to 127.0.0.1 port 7379 (#0)
*   Trying 127.0.0.1... connected
* Connected to 127.0.0.1 (127.0.0.1) port 7379 (#0)
> GET /SET/aa/cc HTTP/1.1 
> User-Agent: curl/7.19.7 (x86_64-redhat-linux-gnu) libcurl/7.19.7 NSS/3.13.1.0 zlib/1.2.3 libidn/1.18 libssh2/1.2.2
> Host: 127.0.0.1:7379
> Accept: */*
>
< HTTP/1.1 200 OK
< Server: Webdis
< Allow: GET,POST,PUT,OPTIONS
< Access-Control-Allow-Origin: * 
< Access-Control-Allow-Headers: *
< Content-Type: application/json
< ETag: "0db1124cf79ffeb80aff6d199d5822f8"
< Connection: Keep-Alive
< Content-Length: 19
<
* Connection #0 to host 127.0.0.1 left intact  
* Closing connection #0 
{"SET":[true,"OK"]}  

   `It` `worked`！

**查看 Redis 配置**

在浏览器上访问时，如 `http://localhost/INFO`，会提示保存为文件，出现这种问题时，有以下方式解决:

    http://localhost/INFO?type=json
    
    http://localhost/INFO?type=txt
    
    http://localhost/INFO.txt
    
    http://localhost/INFO.json     不支持

展示结果如下：

    redis_version:2.4.15
    redis_git_sha1:00000000
    redis_git_dirty:0
    arch_bits:64
    multiplexing_api:epoll
    gcc_version:4.4.6
    process_id:2811
    uptime_in_seconds:9264
    uptime_in_days:0
    lru_clock:120413
    used_cpu_sys:0.27
    used_cpu_user:0.17
    used_cpu_sys_children:0.08
    used_cpu_user_children:0.01
    connected_clients:6
    connected_slaves:1
    client_longest_output_list:0
    client_biggest_input_buf:0
    blocked_clients:0
    used_memory:1984648
    used_memory_human:1.89M
    used_memory_rss:9461760
    used_memory_peak:2001536
    used_memory_peak_human:1.91M
    mem_fragmentation_ratio:4.77
    mem_allocator:jemalloc-3.0.0
    loading:0
    aof_enabled:1
    changes_since_last_save:0
    bgsave_in_progress:0
    last_save_time:1343372169
    bgrewriteaof_in_progress:0
    total_connections_received:85
    total_commands_processed:97
    expired_keys:0
    evicted_keys:0
    keyspace_hits:64
    keyspace_misses:2
    pubsub_channels:0
    pubsub_patterns:0
    latest_fork_usec:94175
    vm_enabled:0
    role:master
    aof_current_size:518985
    aof_base_size:518985
    aof_pending_rewrite:0
    aof_buffer_length:0
    aof_pending_bio_fsync:0
    slave0:127.0.0.1,36806,online
    db0:keys=3,expires=0

**注意事项**

在 `make` 操作时，可能会出现以下问题

> cc -c -O3 -Wall -Wextra -I. -Ijansson/src -Ihttp-parser -o webdis.o
> webdis.c In file included from webdis.c:1:  server.h:4:19: error:
> event.h: No such file or directory In file included from webdis.c:1:
> server.h:14: error: field ‘ev’ has incomplete type make: ***
> [webdis.o] Error 1

**原因分析**

缺少 `libevent-devel` 包

**解决办法**

    yum install libevent-devel

**LAST**

`Webdis` 写不了复杂的逻辑。

如果要对 `Redis` 进行复杂的逻辑操作，推荐使用 `Nginx-Lua` 模块，`Lua` 脚本 提供强大的功能，可以直接取代 `PHP` 脚本。
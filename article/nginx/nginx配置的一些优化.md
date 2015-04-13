## worker_processes and worker_connections ##

    worker_processes  1;
    worker_connections  1024;

这两个参数的默认值，基本满足一般网站的日常需求。但是根据服务器状况，来做点微调，效果会更好！

    max_clients = worker_processes * worker_connections
默认配置中，一台服务器处理1000个并发。当服务器的磁盘慢时，就会导致 Nginx 在 I/O 操作上被锁住。

为了避免此类问题，可以做如下处理

    worker_processes [number of processor cores]

接下来，我们看看CPU有多少个内核

    cat /proc/cpuinfo |grep processor
    processor   : 0
    processor   : 1
    processor   : 2
    processor   : 3

有4个内核，设置参数如下：

    worker_processes 4;

有人认为这两个参数的值越大越好，这是不正确的。导致资源浪费的同时可能会导致一些严重的问题产生。

## 隐藏Nginx版本信息 ##

基于安全原因，不想让用户知道当前使用的 Nginx 版本信息等，需要做如下设置

    server_tokens off;

## 提高上传文件大小限制 ##

如果遇到以下错误，你就应该提高上传大小限制了。

    “Request Entity Too Large” (413)
参数设置

    client_max_body_size 20m;
    client_body_buffer_size 128k;

## 浏览器缓存控制 ##

如果你想节省资源和带宽，引入浏览器缓存不失为一个好的方案。这里，主要针对一些静态文件。

    location ~* \.(jpg|jpeg|gif|png|css|js|ico|xml)$ {
        access_log        off;
        log_not_found     off;
        expires           360d;
    }

## 转发请求给PHP-FPM ##

两种方式：TCP/IP 和 Unix Socket。

    # Pass PHP scripts to PHP-FPM
    location ~* \.php$ {
        fastcgi_index   index.php;
        fastcgi_pass    127.0.0.1:9000;
        #fastcgi_pass   unix:/var/run/php-fpm/php-fpm.sock;
        include         fastcgi_params;
        fastcgi_param   SCRIPT_FILENAME    $document_root$fastcgi_script_name;
        fastcgi_param   SCRIPT_NAME        $fastcgi_script_name;
    }

## 禁止访问隐藏文件 ##

在服务器根目录或公共目录下，有很多隐藏文件，比如.开头的文件，版本控制文件以及目录 .svn .htaccess 等。这些都不应该让用户看到。

    location ~ /\. {
        access_log off;
        log_not_found off; 
        deny all;
    }
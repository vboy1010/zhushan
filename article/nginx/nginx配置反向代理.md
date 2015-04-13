**传统代理**

早期，我们通常需要通过代理服务器，来访问互联网上的 WEB 站点。代理服务器接入了互联网，而我们通过内部网络与代理服务器相连。

现在，为了访问某些被禁的网站，我们也会通过特定的代理服务器，绕过某些限制，来访问目标站点。

**NAT**

不过现在网关通常使用 `NAT` - 网络地址转换。

> 将 `PC` 的内部 `IP` 地址和网关的外网 `IP` 地址进行相互转换，使得 `PC` 发出的请求可以顺利到达外部网络的 `WEB`
> 服务器。
> 
> 同时，将返回的正确数据正确的传送给内部网络的PC。

使用 `NAT`，`PC` 便不用直接暴露在互联网中，提高了安全性能。

**反向代理**

`Reverse Proxy`，与传统代理相反，`WEB` 服务器隐藏在代理服务器之后。

这里我们在一台服务器上，配置反向代理，采用 `APACHE` 和 `NGINX`。

`Nginx` 作为 `Apache` 的反向代理，将用户的请求转发到 `Apache` 监听的 `8081` 端口。

[`APACHE`]

        Listen 8081

[`NGINX`]

        server_name  www.test.com;
        listen       80;
        location ~ \.php$ {
            proxy_pass http://127.0.0.1:8081;
        }

测试一下：

    ab -n5 http://www.test.com/phpinfo.php

查看日志：

[`Nginx`] 

    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18 "-" "ApacheBench/2.3"
    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18 "-" "ApacheBench/2.3"
    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18 "-" "ApacheBench/2.3"
    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18 "-" "ApacheBench/2.3"
    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18 "-" "ApacheBench/2.3"

[`Apache`] 

    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18
    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18
    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18
    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18
    127.0.0.1 - - [22/Aug/2014:11:42:17 +0800] "GET /phpinfo.php HTTP/1.0" 200 18

**结论**

从上述日志看出，`Nginx` 对于 `php` 文件的请求，全部都转到 `Apache` 处理了。
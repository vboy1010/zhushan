## 什么是CGI？ ##
CGI是一种协议，通过这种协议（或约定的规则），WEB服务器可以和应用程序进行数据交互处理。

CGI包含三个方面：

 - 环境变量（请求类型，请求IP..）
 - 标准输入（请求主体）
 - 标准输出（请求响应）

简而言之，CGI在环境变量中，描述了请求的基本信息；在标准输入中，描述了请求主体是如何传入的；在标准输出中，描述了请求响应是如何输出的。

## 什么是FASTCGI？ ##
FASTCGI 是 CGI 的改进方案，主要优点是把动态语言和 HTTP Server 分离开来。

因此 Nginx 与 PHP/PHP-FPM 经常被部署在不同的服务器上，以分担前端 Nginx 服务器的压力。

使 Nginx 专一处理静态请求和转发动态请求，而 PHP/PHP-FPM 服务器专一解析 PHP 动态请求。

## 区别 ##
*CGI*：

 - 每次请求PHP都要重新解析php.ini，重新加载全部扩展和初始化数据结构
 - fork-and-execute模式
 - 高并发时，效率低

*FASTCGI*：

 - 采用C/S结构，HTTP服务器和脚本解析服务器分离，多个脚本解析守护进程
 - 扩展加载和数据结构初始化，在进程启动时只发生一次
 - 多个CGI程序保持在内存中，接受FastCGI进程管理器调度

*FastCGI原理图*

![请输入图片描述][1]


  [1]: http://segmentfault.com/img/bVb5Lw
 
Nginx 将 CGI 请求发送给 Socket：

 - 通过 FastCGI 接口，Wrapper 接收到请求，然后派生出一个新的线程，这个线程调用解释器或者外部程序处理脚本并读取返回数据
 - Wrapper 再将返回的数据通过 FastCGI 接口，沿着固定的 Socket 传递给 Nginx
 - Nginx 将返回的数据发送给客户端

## PHP-FPM ##
PHP-FPM 是 FASTCGI 协议的一种实现，在 PHP5.3.× 版本中就开始内置该进程管理器。

## Spawn-fcgi ##
Spawn-fcgi是 HTTP 服务器 lighttpd 的一部分，目前已经独立成为一个项目，一般与 lighttpd 配合使用来支持PHP。

但是 ligttpd 的spwan-fcgi 在高并发访问的时候，会出现内存泄漏甚至自动重启 FastCGI 的问题。
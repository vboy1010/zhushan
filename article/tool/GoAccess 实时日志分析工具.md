**GoAccess**

`GoAccess` 是一款开源、实时，运行在命令行终端下的 `Web` 日志分析工具。

该工具提供快速、多样的 `HTTP` 状态统计。

分析结果，可以通过 `XShell` 等客户端工具查看，并且可以生成 `Html` 报告。

`GitHub` 地址：https://github.com/allinurl/goaccess

官网地址：http://goaccess.io/

**安装**

    $ yum -y install glib2 glib2-devel ncurses ncurses-devel geoIP geoIP-devel
    $ wget http://tar.goaccess.io/goaccess-0.9.tar.gz
    $ tar -xzvf goaccess-0.9.tar.gz
    $ cd goaccess-0.9/
    $ ./configure --enable-geoip --enable-utf8
    $ make
    # make install
    
默认配置文件在 `/usr/local/etc/goaccess.conf`

根据你的日志格式，配置以下参数，这里只需要将 `#` 去掉即可。

    time-format
    date-format
    log-format

接下来我们测试一下

    goaccess  -f /usr/local/nginx/logs/access.log -a > /tmp/report.html

这里生成了一个 html 文件，我们在浏览器里打开看下。

![图片描述][1]

更详细的使用，后续继续研究。。。


  [1]: /img/bVlPQ0
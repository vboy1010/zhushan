**CentOS版本？**

    cat /etc/redhat-release
    >> CentOS release 5.4 (Final)

**系统内核**

    uname -a
    >> Linux test33x.ops.xxx.net 2.6.18-164.el5xen #1 SMP Thu Sep 3 04:03:03 EDT 2009 x86_64 x86_64 x86_64 GNU/Linux

**安装PHP**

    wget http://cn2.php.net/get/php-5.5.13.tar.gz/from/this/mirror
    
    tar zxf php-5.5.13.tar.gz
    
    cd php-5.5.13
    
    ./configure --prefix=/usr/local/php \
    --with-config-file-path=/usr/local/php/etc \
    --with-config-file-scan-dir=/usr/local/php/etc/conf.d \
    --enable-fpm \
    --with-fpm-user=www \
    --with-fpm-group=www \
    --with-pear \
    --with-curl \
    --with-iconv \
    --with-mcrypt \
    --with-mhash \
    --with-zlib \
    --with-mysql \
    --with-mysqli \
    --with-pdo-mysql \
    --enable-zip \
    --enable-sockets \
    --enable-soap \
    --enable-mbstring \
    --enable-xml

    make
    make install

**配置PHP-FPM**

    //创建配置文件，并将其复制到正确的位置
    cp php.ini-development /usr/local/php/etc/php.ini
    cp /usr/local/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf
    cp sapi/fpm/php-fpm /usr/local/bin
    cp /usr/local/php/bin/php /usr/local/bin
    cp /usr/local/php/bin/php /usr/bin
    
**启动PHP-FPM**

    /usr/local/bin/php-fpm

**运行PHP**

    php -v
    >> PHP 5.5.13 (cli) (built: Jun 17 2014 15:15:36) 
    >> Copyright (c) 1997-2014 The PHP Group
    >> Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies

**查看PHP的扩展模块**

    php -m

    [PHP Modules]

    Core
    ctype
    curl
    date
    dom
    ereg
    fileinfo
    filter
    hash
    iconv
    json
    libxml
    mbstring
    mcrypt
    mysql
    mysqli
    mysqlnd
    pcre
    PDO
    pdo_mysql
    pdo_sqlite
    Phar
    posix
    Reflection
    session
    SimpleXML
    soap
    sockets
    SPL
    sqlite3
    standard
    tokenizer
    xml
    xmlreader
    xmlwriter
    zip
    zlib

    [Zend Modules]

安装配置完成！
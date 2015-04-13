**PHPIZE**

`PHPIZE` 命令是用来准备 `PHP` 扩展库的编译环境的。通过它可以建立 `PHP` 的外挂模块。

当 `PHP` 已经编译安装完成后，若后续开发中，需要开启一些扩展模块，则可以通过 `PHPIZE` 来达到这个目的，无需再重新编译 `PHP`。

比如，我们要安装 `OPENSSL` 模块

进入 `PHP` 的 `ext` 目录，打开 `openssl` 目录

**执行命令**：

    //重命名此文件，原因不知道为啥！
    mv config0.m4 config.m4

    /usr/local/php/bin/phpize

    >> Configuring for:
    >> PHP Api Version:         20121113
    >> Zend Module Api No:      20121212
    >> Zend Extension Api No:   220121212

    ./configure --with-php-config=/usr/local/php/bin/php-config

    make

    make install

    >> Installing shared extensions:     /usr/local/php/lib/php/extensions/no-debug-non-zts-20121212/

    ll /usr/local/php/lib/php/extensions/no-debug-non-zts-20121212

    >> -rwxr-xr-x 1 root root  381011 06-27 16:44 openssl.so

**修改php.ini**

    加入下面两行

    extension_dir = "/usr/local/php/lib/php/extensions/no-debug-non-zts-20121212"

    extension=openssl.so

**查看PHP扩展**

    重启 `PHP-FPM`   
    
    php -m | grep openssl

    >> openssl
    
**APC**

`APC`：`Alternative PHP Cache`，这是一个开放自由的 `PHP opcode` 缓存。

它的目标是提供一个自由、开放、健全的框架用于缓存和优化 `PHP` 的中间代码。

> 随着 `Opcache` 进入 `PHP` 源代码树, `APC` 也就不做更新了, 主要的精力都迁移到了 `Zend Optimizer Plus` 的进一步开发上。
> 
> `Zend Optimizer Plus` 是由 `Zend` 公司开发的一个 `PHP` 性能提升工具, 在 `PHP5.5` 开始, 已经随着 `PHP` 的源代码一起发布了, 并且也改名为: `Opcache`。

**安装步骤**

注意：`APC` 不支持高版本的 `PHP`，这里安装用的是 `PHP5.3.10`。

    wget http://pecl.php.net/get/APC-3.1.13.tgz

    tar zxvf APC-3.1.13.tgz

    cd APC-3.1.13

    /usr/local/php/bin/phpize

    ./configure --enable-apc --enable-mmap --enable-apc-spinlocks --disable-apc-pthreadmutex --with-php-config=/usr/local/php/bin/php-config

    make

    make install

**配置PHP.ini**

    vim /usr/local/php/lib/php.ini

加入以下行：

    [apc]

    extension=apc.so

    apc.enabled = 1

    apc.cache_by_default = on

    apc.shm_segments = 1

    apc.shm_size = 64

    apc.ttl = 7200

    apc.user_ttl = 7200

    apc.num_files_hint = 0

    apc.write_lock = On

**重启PHP-FPM**

    /etc/init.d/php-fpm restart

复制 `apc.php` 至 网站根目录

    cp apc.php /www-root/

浏览器打开 `http://your.host.com/apc.php`

![请输入图片描述][1]


  [1]: http://segmentfault.com/img/bVcHJW
**Session 的存储方式**

在 php.ini 文件中，进行配置。

**涉及配置参数**：

     - session.save_handler
       
     - session.save_path
注意：这两个参数可以在 PHP 中通过 ini_set 来设置，不用直接覆盖原 php.ini 中的值。

**一、文件存储**

    session.save_handler = files
    
    session.save_path = "N;MODE;/path"

**注释**：N 表示多级目录，值为数字。MODE 表示创建的 Session 文件权限。/path 表示 Session 存储路径。

这里我设置

    session.save_path = "2;600;/tmp/"

重启PHP-FPM，然后写个测试脚本 test.php，代码里运行 session_start(); 

结果报错

    PHP Warning:  session_start(): open(/tmp/h/p/sess_hpbfs95c9omtfn30h5lt43i597, O_RDWR) failed: No such file or directory

为什么呢？

我们来看下PHP官网怎么说的吧

    此指令还有一个可选的 N 参数来决定会话文件分布的目录深度。例如，设定为 '5;/tmp' 将使创建的会话文件和路径类似于 /tmp/4/b/1/e/3/sess_4b1e384ad74619bd212e236e52a5a174If。
    
    要使用 N 参数，必须在使用前先创建好这些目录。
    
    在 ext/session 目录下有个小的 shell 脚本名叫 mod_files.sh，windows 版本是 mod_files.bat 可以用来做这件事。
    
    此外注意如果使用了 N 参数并且大于 0，那么将不会执行自动垃圾回收，更多信息见 php.ini。
    
    另外如果用了 N 参数，要确保将 session.save_path 的值用双引号 "quotes" 括起来，因为分隔符分号（ ;）在 php.ini 中也是注释符号。
    
    文件储存模块默认使用 mode 600 创建文件。通过 修改可选参数 MODE 来改变这种默认行为： N;MODE;/path ，其中 MODE 是 mode 的八进制表示。 MODE 设置不影响进程的掩码(umask)。
    
    Caution：使用以上描述的可选目录层级参数 N 时请注意，对于绝大多数站点，大于1或者2的值会不太合适——因为这需要创建大量的目录：例如，值设置为 3 需要在文件系统上创建 64^3 个目录，将浪费很多空间和 inode。仅仅在绝对肯定站点足够大时，才可以设置 N 大于2。

了解这些，我们就开始处理 Session 存储目录的创建了，注意子目录的权限问题。

    bash /path/to/mod_files.sh

使用多级目录的后果就是，你必须手动清理这些 Session。

**二、Redis**

首先你得安装了 Redis 扩展

    session.save_handler = redis
    
    session.save_path = "tcp://ip:port?auth=secret"

重启PHP-FPM，然后写个测试脚本 test.php，代码里运行 session_start();

我们看看效果

    redis-cli
    
    127.0.0.1:6379> KEYS *
    1) "PHPREDIS_SESSION:fi08i7ms4rtrdsb6n1oqb0fek2"
    
    127.0.0.1:6379> TYPE "PHPREDIS_SESSION:fi08i7ms4rtrdsb6n1oqb0fek2"
    string
    
    127.0.0.1:6379> get "PHPREDIS_SESSION:fi08i7ms4rtrdsb6n1oqb0fek2"
    "admin_user|a:3:{s:8:\"username\";s:4:\"test\";s:4:\"name\";s:4:\"test";s:5:\"email\";s:12:\"test@test.cn\";}"

    127.0.0.1:6379> ttl "PHPREDIS_SESSION:fi08i7ms4rtrdsb6n1oqb0fek2"
    (integer) 292

可以看到 Session 存入了 Redis 中，数据结构用的是 String。

**TODO：**多机房的 Redis 存储怎么弄？
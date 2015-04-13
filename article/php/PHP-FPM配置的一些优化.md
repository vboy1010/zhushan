这三个参数默认是关闭的。

    emergency_restart_threshold, emergency_restart_interval and process_control_timeout

不过，出于优化的目的，我们把它们打开

    emergency_restart_threshold 10
    emergency_restart_interval 1m
    process_control_timeout 10s

**有以下优点**

在1分钟内，出现 SIGSEGV 或者 SIGBUS 错误的 PHP-CGI 进程数超到10个时，PHP-FPM 就会优雅的自动重启。

第三个参数配置，设置子进程接受主进程复用信号的超时时间。
首先，我们关注下 PHP-FPM 的运行方式：

    static ：表示在 `php-fpm` 运行时直接 `fork` 出 `pm.max_chindren` 个子进程，
    
    dynamic：表示，运行时 `fork` 出 `start_servers` 个进程，随着负载的情况，动态的调整，最多不超过 `max_children` 个进程。

  一般推荐用 `static`。

 - 优点是不用动态的判断负载情况，提升性能；

 - 缺点是多占用些系统内存资源。

`PHP-FPM` 子进程数量，是不是越多越好？

当然不是，`pm.max_chindren`，进程多了，增加进程管理的开销以及上下文切换的开销。

更核心的是，能并发执行的 `php-fpm` 进程不会超过 `cpu` 个数。

如何设置，取决于你的代码

 - 如果代码是 `CPU` 计算密集型的，`pm.max_chindren` 不能超过 `CPU` 的内核数。

 - 如果不是，那么将 `pm.max_chindren` 的值大于 `CPU` 的内核数，是非常明智的。

国外技术大拿给出这么个公式：

在 `N + 20%` 和 `M / m` 之间。

> N 是 CPU 内核数量。 
> M 是 PHP 能利用的内存数量。 
> m 是每个 PHP 进程平均使用的内存数量。

适用于 `dynamic` 方式。

`static`方式：`M / (m * 1.2)`

当然，还有一种保险的方式，来配置 `max_children`。适用于 `static` 方式。

 - 先把 `max_childnren` 设置成一个比较大的值。
 - 稳定运行一段时间后，观察 `php-fpm` 的 `status` 里的 `max active processes` 是多少
 - 然后把 `max_children` 配置比它大一些就可以了。

`pm.max_requests`：指的是每个子进程在处理了多少个请求数量之后就重启。

这个参数，理论上可以随便设置，但是为了预防内存泄漏的风险，还是设置一个合理的数比较好。
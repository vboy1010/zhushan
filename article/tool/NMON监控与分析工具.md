`NMON` 是一种在 `AIX` 与各种 `Linux` 操作系统上广泛使用的监控与分析工具。

相对于其它一些系统资源监控工具来说，`NMON` 所记录的信息是比较全面的。

它能在系统运行过程中实时地捕捉系统资源的使用情况，并且能输出结果到文件中，然后通过 `nmon_analyzer` 工具产生数据文件与图形化结果。

**官网**：http://nmon.sourceforge.net/

    wget http://nmon.sourceforge.net/docs/MPG_nmon_for_Linux_14a_binaries.zip

    unzip MPG_nmon_for_Linux_14a_binaries.zip

    cp nmon_x86_64_centos5 /usr/local/bin/nmon

    chmod a+x /usr/local/bin/nmon

**监测功能**：

 - `CPU`占用率
 - 内存使用情况
 - 磁盘`I/O`速度、传输和读写比率
 - 文件系统的使用率
 - 网络`I/O`速度、传输和读写比率、错误统计率与传输包的大小  
 - 消耗资源最多的进程
 - 计算机详细信息和资源
 - 页面空间和页面`I/O`速度
 - 用户自定义的磁盘组
 - 网络文件系统

**开始监控**：

    >> 执行命令 nmon

出现下图：

![请输入图片描述][1]


  [1]: http://segmentfault.com/img/bVcPqI
**Zend Engine** 

作为 `PHP` 语言的核心， `Zend Engine` 存在于 `PHP` 源码目录中的 `Zend` 子目录。

**Why Zend Engine ?**

 - `PHP3` 采用的是边解释、边执行的运行方式，运行效率很差。
 - 代码整体耦合度比较高，可扩展性也不够好。

1997年，`Zeev Suraski` 和 `Andi Gutmans` 决定重写代码以解决这两个问题。

最终他俩把该项技术的核心引擎命名为 `Zend Engine`，`Zend` 的意思即为 `Zeev` + `Andi`。

**Zend Engine 功能**

 先进行预编译( `Compile` )，然后再执行( `Execute` )。

 - 词法分析（`Lexer`）：将代码切分为一个个的标记`Toekn`。

 - 语法分析（`Parser`）：语法检查。

 - 生成操作码（`opcode`）：`Zend` 引擎对这些 `Token` 进行编译， 将代码编译为 `opcode`，并绑定相应的参数、和函数调用。

 - 执行（`execute`）：`Zend` 引擎执行这些 `opcode`。

 - 内存管理

详细过程如下图所示：

![Zend Engine的功能][1]

**PHP源码目录结构**

    /    ：主要包含一些说明文件以及设计方案。

    Zend ：Zend 引擎的实现目录。包括词法语法解析，OPCODE，提供语言运行环境。

    TSRM ：线程安全资源管理器。

    build：放置一些和源码编译相关的一些文件。

    ext  ：官方扩展目录。包括array系列，pdo系列，spl系列等函数的实现。

    main ：最为核心的文件，实现PHP的基本设施。

    pear ：PHP 扩展与应用仓库。

    sapi ：各种服务器抽象层的代码。例如apache的mod_php，cgi，fastcgi以及fpm等等接口。

    tests：PHP的测试脚本集合。

    scripts：Linux 下的脚本目录。

    win32：Windows平台相关的一些实现。

**PHP 核心**

`PHP` 核心由两部分组成：`Zend Engine` 和 `PHP Core`。

`PHP Core` 绑定了 `SAPI` 层，`PHP` 对与上层 `"服务器"` 的通信进行了抽象，把所有的逻辑都抽象、封装到了`SAPI`。

对于上层的服务器来说，它们对 `PHP` 的调用就可以通过 `SAPI` 来进行，实现了`"解耦和"`。

常见的调用 `SAPI` 方式有：

 - `mod_php5`：`PHP module for Apache`。
 - `CGI`：`Fork-And-Execute`。 
 - `Fastcgi`：常驻 (`Long-Live`) 型的 `CGI`。
 - `CLI`：`PHP` 命令行模式。

**The Architecture of PHP**

![The architecture of PHP.][2]

  [1]: http://segmentfault.com/img/bVcGiX
  [2]: http://segmentfault.com/img/bVcGi8
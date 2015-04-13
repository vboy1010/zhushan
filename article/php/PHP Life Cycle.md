**PHP Life Cycle**

`PHP` 生命周期，一切从 `SAPI` 开始。

**PHP**

 - `内核`：处理请求、文件流、错误处理等相关操作。

 - `Zend引擎`：将源文件转换成机器语言，然后在虚拟机上运行它。

 - `扩展层`：一组函数、类库和流。

**单进程SAPI生命周期**

一个 `PHP` 进程，在其生命周期内，经历了数个阶段。

> `MINIT`：每个模块都依次执行模块初始化。涉及全局变量，常量，INI文件，类。
> `RINIT`：当进程开始处理 `PHP` 请求时，每个模块依次执行请求初始化。涉及请求变量、环境变量。
> `Zend Engine`：编译，执行。
> `RSHUTDOWN`：当请求处理完毕，每个模块依次执行请求终止。
> `Zend Engine`：垃圾收集 - 变量释放。
> `MSHUTDOWN`：当 `PHP` 进程关闭时，与其关联的模块将依次从内存中销毁，即模块关闭。

![单进程SAPI生命周期][1]

**多线程SAPI生命周期**

多线程的 SAPI 生命周期，`MINIT` 和 `MSHUTDOWN` 在进程的存活期内，只需要执行一次。

![多线程SAPI生命周期][2]

**Apache的生命周期**

![请输入图片描述][3]

**Apache的请求处理流程**

![Apache的请求处理流程][4]


  [1]: http://segmentfault.com/img/bVcGfB
  [2]: http://segmentfault.com/img/bVcGfC
  [3]: http://segmentfault.com/img/bVcHCv
  [4]: http://segmentfault.com/img/bVcHCp
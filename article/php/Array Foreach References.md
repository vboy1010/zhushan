**PHP 循环数组时，必须小心的坑！**

    <?php
    
    $arr = array(1, 2, 3, 4, 5);
    
    echo "The First Loop: \n";
    
    foreach ($arr as &$i) {
        $i++;
        echo $i."\n";
    }
    
    echo "The Second Loop: \n";
    
    foreach ($arr as $i) {
        echo $i."\n";
    }
    ?>
    
输出如下：

    The First Loop: 
    1
    2
    3
    4
    5
    The Second Loop: 
    1
    2
    3
    4
    4

我们好像没对数组做什么修改吧？但是输出结果为什么和期望的不一致呢？

问题就出在 “引用传递”。

第一次循环后，变量 $i 仍然保留着数组最后一个元素的值。

这里有个疑问，第一次循环时，变量 $i 是传的引用，为什么数组的元素的值不跟着改变？

原因：When the ***iteration*** continues the ***reference is broken*** and ***$v is made a reference to the different elements***. So after the iteration ends $v is a reference to the last element.

国外大神写了一篇文章，讲解的很清晰。

http://schlueters.de/blog/archives/141-References-and-foreach.html

“引用” 参考PHP文档

http://php.net/manual/zh/language.references.php#language.references
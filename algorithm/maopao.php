<?php
/**
 * 冒泡排序算法
 */

$bubble = array(1,43,54,62,21,66,32,78,36,76,39);

$len = count($bubble);

for ($i = 0; $i < $len; $i++) {

    $flag = false; //标志位

    echo implode("\t", $bubble) . "\n"; //打印冒泡过程

    for ($j = $len - 1; $j >= $i ; $j--) {
        if ($bubble[$j] < $bubble[$j-1]) {
            $switch = $bubble[$j];
            $bubble[$j] = $bubble[$j-1];
            $bubble[$j-1] = $switch;
            $flag = true;
        }
    }

    if (!$flag) { //没有冒泡时，退出循环
        break;
    }
}
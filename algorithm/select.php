<?php
/**
 * 选择排序算法
 * 选择排序(Selection sort)是一种简单直观的排序算法。
 * 工作原理如下:
 * 1.首先在[未]排序序列中找到最小元素，存放到排序序列的起始位置;
 * 2.再从剩余[未]排序元素中继续寻找最小元素，然后放到排序序列末尾。
 * 3.以此类推，直到所有元素均排序完毕。
 */

$select = array(1,43,54,62,21,66,32,78,36,76,39);

$len = count($select);

for ($i = 0; $i < $len - 1; $i++) {

    echo implode("\t", $select) . "\n"; //打印排序过程

    $s = $i;

    for ($j = $i + 1; $j < $len; $j++) {
        if ($select[$s] > $select[$j]) {
            $s = $j;
        }
    }

    if ($s != $i) {
        $switch = $select[$s];
        $select[$s] = $select[$i];
        $select[$i] = $switch;
    }
}
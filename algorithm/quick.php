<?php
/**
 * 快速排序算法
 * 工作原理如下:
 * 1.从数列中挑出一个元素，称为 “基准”。
 * 2.重新排序数列，所有元素比基准值小的摆放在基准前面，所有元素比基准值大的摆在基准的后面（相同的数可以到任一边）。
 * 3.在这个分区退出之后，该基准就处于数列的中间位置。这个称为分区（partition）操作。
 * 4.递归地（recursive）把小于基准值元素的子数列和大于基准值元素的子数列排序。
 */

$quick = array(1,43,54,62,21,66,32,78,36,76,39);

function quickSort($quick)
{
    $len = count($quick);

    if ($len <= 1) {
        return $quick;
    }

    $base = $quick[0];

    $left  = array();
    $right = array();

    for ($i = 1; $i < $len; $i++) {
        if ($quick[$i] > $base) {
            $right[] = $quick[$i];
        } else {
            $left[] = $quick[$i];
        }
    }

    $left  = quickSort($left);
    $right = quickSort($right);

    echo implode("\t", array_merge($left, array($base), $right)) . "\n"; //打印排序过程

    return array_merge($left, array($base), $right);
}

//Test Case
quickSort($quick);

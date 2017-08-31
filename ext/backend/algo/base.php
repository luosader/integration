<?php 
// http://blog.csdn.net/kirsten_z/article/details/52515573
// http://blog.csdn.net/qishouzhang/article/details/47208843
require_once 'config.php';

switch ($rec) {
    case 'sel':
        //选择排序(不稳定)  
        function SelectSort($arr){  
            $length = count($arr);  
            if($length<=1){  
                return $arr;  
            }  
            for($i=0;$i<$length;$i++){  
                $min = $i;  
                for($j=$i+1;$j<$length;$j++){  
                    if($arr[$j]<$arr[$min]){  
                        $min = $j;  
                    }  
                }  
                if($i != $min){  
                    $tmp = $arr[$i];  
                    $arr[$i] = $arr[$min];  
                    $arr[$min] = $tmp;  
                }  
            }  
            return $arr;  
        }  
        echo "选择排序：";  
        echo implode(' ',SelectSort($arr))."<br/>";

        debug('思路：每一趟在n-i+1(i = 1,2,…,n-1)个记录中选择关键字最小的记录作为有序序列中第i个记录，其中最简单的是简单选择排序，其过程如下：通过n-i次关键字间的比较，从n-i+1个记录中选择出关键字最小的记录，并各第i个记录交换之。');
        function select_sort($arr) {
            // 双循环完成，外层控制轮数，当前的最小值。内层控制的比较次数
            // $i 当前最小值的位置，需要参与比较的元素
            for ($i=0,$len=count($arr); $i < $len-1; $i++) { 
                // 先假设最小的值的位置
                $p = $i;
                // $j 当前都需要和哪些元素比较，$i后边的。
                for ($j=$i+1; $j < $len; $j++) { 
                    // $arr[$p] 是当前已知的最小值
                    if ($arr[$p]>$arr[$j]) {
                        // 比较发现更小的，记录下最小值位置；并在下次比较时采用该最小值进行比较。
                        $p = $j;
                    }
                }
                // 已经确定了当前的最小值的位置，保存到 $p 中。如果发现最小值的位置与当前假设的位置$i不同，则位置互换即可
                if ($p!=$i) {
                    $tmp = $arr[$p];
                    $arr[$p] = $arr[$i];
                    $arr[$i] = $tmp;
                }
            }
            return $arr;
        }
        break;

    case 'ist':
        //插入排序  
        function InsertSort($arr){  
            $length = count($arr);  
            if($length <=1){  
                return $arr;  
            }  
            for($i=1;$i<$length;$i++){  
                $x = $arr[$i];  
                $j = $i-1;  
                while($x<$arr[$j] && $j>=0){  
                    $arr[$j+1] = $arr[$j];  
                    $j--;  
                }  
                $arr[$j+1] = $x;  
            }  
            return $arr;  
        }  
        echo '插入排序：';  
        echo implode(' ',InsertSort($arr))."<br/>";

        debug('思路：通过构建有序序列，对于未排序数据，在已排序序列中从后向前扫描，找到相应位置并插入。插入排序在实现上，通常采用in-place排序（即只需用到O(1)的额外空间的排序），因而在从后向前扫描过程中，需要反复把已排序元素逐步向后挪位，为最新元素提供插入空间。');
        function insert_sort($arr)
        {
            /*
             * 区分 哪部分是已经排序好的 ，哪部分是没有排序的，找到其中一个需要排序的元素，这个元素 就是从第二个元素开始，到最后一个元素都是这个需要排序的元素
             * 利用循环就可以标志出来
             * i循环控制每次需要插入的元素，一旦需要插入的元素控制好了，间接已经将数组分成了2部分，下标小于当前（左边的）是排序好的序列
            */
            for ($i=1,$len=count($arr); $i < $len; $i++) { 
                // 获得当前需要比较的元素值
                $tmp = $arr[$i];
                // 内层循环控制比较并插入
                for ($j=$i-1; $j >=0 ; $j--) { 
                    // $arr[$i];// 需要插入的元素
                    // $arr[$j];// 需要比较的元素
                    if ($tmp < $arr[$j]) {
                        // 发现插入的元素要小，交换位置，将后面的元素与前面的元素交换
                        $arr[$j+1] = $arr[$j];
                        // 将前面的数值设为当前需要交换的数值
                        $arr[$j] = $tmp;
                    } else {
                        // 如果碰到不需要移动的元素，由于是已经排序好了的数组，则前面的就不需要再次比较了
                        break;
                    }
                }
            }
            // 将这个元素插入到已经排序好的序列内，返回
            return $arr;
        }
        break;

    case 'quik':
        //快速排序  
        function QSort($arr){  
            $length = count($arr);  
            if($length <=1){  
                return $arr;  
            }  
            $pivot = $arr[0];//枢轴  
            $left_arr = array();  
            $right_arr = array();  
            for($i=1;$i<$length;$i++){//注意$i从1开始0是枢轴  
                if($arr[$i]<=$pivot){  
                    $left_arr[] = $arr[$i];  
                }else{  
                    $right_arr[] = $arr[$i];  
                }  
            }  
            $left_arr = QSort($left_arr);//递归排序左半部分  
            $right_arr = QSort($right_arr);//递归排序右半部份  
            return array_merge($left_arr,array($pivot),$right_arr);//合并左半部分、枢轴、右半部分  
        }  
        echo "快速排序：";  
        echo implode(' ',QSort($arr))."<br/>";

        debug('思路：先对数组进行分割， 把大的元素数值放到一个临时数组里，把小的元素数值放到另一个临时数组里（这个分割的点可以是数组中的任意一个元素值，一般用第一个元素，即$array[0]），然后继续把这两个临时数组重复上面拆分，最后把小的数组元素和大的数组元素合并起来。这里用到了递归的思想。'); 

        //快速排序（数组排序）
        function quick_sort($arr) { 
            // 先判断是否需要继续进行
            $len = count($arr);
            if ($len <= 1) { return $arr; }
            // 如果没有。说明数组内的元素个数多余1个，需排序
            // 选择一个标尺，选择第一个元素
            $base_num = $arr[0];
            // 遍历 除了标尺外的所有元素，按照大小关系放入两个数组内
            // 初始化两个数组
            $lefts = array();// 小于标尺的
            $rights = array();// 大于标尺的
            for ($i=1; $i < $len; $i++) { 
                if ($base_num > $arr[$i]) {
                    // 放入左边
                    $lefts[] = $arr[$i];
                } else {
                    // 放入右边
                    $rights[] = $arr[$i];
                }
            }
            // 在分别对 左边 和 右边 的数组进行相同的排序处理，递归调用这个函数，并记录结果
            $lefts = quick_sort($lefts);
            $rights = quick_sort($rights);
            // 合并左边 和 右边
            return array_merge($lefts,array($base_num),$rights);
        }

        break;

    default:
        //冒泡排序（数组排序）
        function BubbleSort($arr){  
            $length = count($arr);  
            if($length<=1){ return $arr; }  
            for($i=0;$i<$length;$i++){  
                for($j=$length-1;$j>$i;$j--){  
                    if($arr[$j]<$arr[$j-1]){  
                        $tmp = $arr[$j];  
                        $arr[$j] = $arr[$j-1];  
                        $arr[$j-1] = $tmp;  
                    }  
                }  
            }  
            return $arr;  
        }  
        echo '冒泡排序：';  
        echo implode(' ',BubbleSort($arr))."<br/>";

        debug('思路：​每次循环排列出一个最大的数。');
        function getpao($arr) {
            $len = count($arr);
            if($len<=1){ return $arr; }
            // 该层循环控制需要冒泡的轮数
            for ($i=1; $i < $len; $i++) { 
            // 该层循环用来控制每轮冒出一个数需要比较的次数
                for ($k=0; $k < $len-$i; $k++) { 
                    if ($arr[$k]>$arr[$k+1]) {
                        $tmp = $arr[$k+1];
                        $arr[$k+1] = $arr[$k];
                        $arr[$k] = $tmp;
                    }
                }
            }
            return $arr;
        }

        debug('基本思想：对需要排序的数组从后往前（逆序）进行多遍的扫描，当发现相邻的两个数值的次序与排序要求的规则不一致时，就将这两个数值进行交换。这样比较小（大）的数值就将逐渐从后面向前面移动。');
        function mysort($arr) {
            for($i = 0; $i < count($arr); $i++) {
                $isSort = false;
                for ($j=0; $j< count($arr) - $i - 1; $j++) {
                    if($arr[$j] < $arr[$j+1]) {
                        $isSort = true;
                        $temp = $arr[$j];
                        $arr[$j] = $arr[$j+1];
                        $arr[$j+1] = $temp ;
                    }
                }
                if($isSort) { break; }
            }
            return $arr;
        }
        debug(mysort($array1));

        break;
}
?>
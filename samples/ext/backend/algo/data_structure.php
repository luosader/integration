<?php 
require_once 'config.php';

switch ($rec) {
    case 'dae':
        echo "思路：";
        //线性表的删除（数组中实现）
        function delete_array_element($array , $i)  
        {  
                $len =  count($array);   
                for ($j= $i; $j<$len; $j ++){  
                        $array[$j] = $array [$j+1];  
                }  
                array_pop ($array);  
                return $array ;  
        }
        break;

    case 'ysf':
        //PHP解决约瑟夫环问题  
        //方法一  
        function joseph_ring($n,$m){  
            $arr = range(1,$n);  
            $i = 0;  
            while(count($arr)>1){  
                $i=$i+1;  
                $head = array_shift($arr);  
                if($i%$m != 0){ //如果不是则重新压入数组  
                    array_push($arr,$head);  
                }  
            }  
            return $arr[0];  
        }  
        //方法二  
        function joseph_ring2($n,$m){  
            $r = 0;  
            for($i=2;$i<=$n;$i++){  
                $r = ($r+$m)%$i;  
            }  
            return $r + 1;  
        }  
        echo "<br/>".joseph_ring(60,5)."<br/>";  
        echo "<br/>".joseph_ring2(60,5)."<br/>";  
        break;
}
?>
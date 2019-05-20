<?php 
require_once 'config.php';

switch ($rec) {
    case 'binary':
        echo "​思路："; 
        //二分查找  
        function binary_search($arr,$low,$high,$key){
            while($low<=$high){  
                $mid = intval(($low+$high)/2);  
                if($key == $arr[$mid]){  
                    return $mid+1;  
                }elseif($key<$arr[$mid]){  
                    $high = $mid-1;  
                }elseif($key>$arr[$mid]){  
                    $low = $mid+1;  
                }  
            }  
            return -1;  
        }
        $key = 6;  
        echo "二分查找{$key}的位置：";  
        echo binary_search(QSort($arr),0,8,$key);

        //二分查找（数组里查找某个元素）
        function bin_sch($array,  $low, $high, $k){   
            if ( $low <= $high){   
                $mid =  intval(($low+$high)/2 );   
                if ($array[$mid] ==  $k){   
                    return $mid;   
                }elseif ( $k < $array[$mid]){   
                    return  bin_sch($array, $low,  $mid-1, $k);   
                }else{   
                    return  bin_sch($array, $mid+ 1, $high, $k);   
                }   
            }   
            return -1;   
        }  
        break;

    case 'sq':
        echo "思路：从数组的第一个元素开始一个一个向下查找，如果有和目标一致的元素，查找成功；如果到最后一个元素仍没有目标元素，则查找失败。";
        //顺序查找  
        function SqSearch($arr,$key){  
            $length = count($arr);  
            for($i=0;$i<$length;$i++){  
                if($key == $arr[$i]){  
                    return $i+1;  
                }  
            }  
            return -1;  
        }  
        $key = 8;  
        echo "<br/>顺序常规查找{$key}的位置：";  
        echo SqSearch($arr,$key);

        //顺序查找
        function seq_search($arr,$n,$k)
        {
            $array[$n] = $k;
            for($i = 0;$i < $n; $i++) {
                if($arr[$i] == $k) {
                    break;
                }
            }
            if($i < $n) {
                return $i;
            } else {
                return -1;
            }
        }
        break;

    case 'file_ext':
        // 高效的从一个标准url中取出文件的扩展名
        function getExt($url)
        {
            $arr = parse_url($url);//parse_url解析一个 URL 并返回一个关联数组，包含在 URL 中出现的各种组成部分
            //'scheme' => string 'http' (length=4)
            //'host' => string 'www.sina.com.cn' (length=15)
            //'path' => string '/abc/de/fg.php' (length=14)
            //'query' => string 'id=1' (length=4)
            $file = basename($arr['path']);// basename函数返回路径中的文件名部分
            $ext = explode('.', $file);
            return $ext[count($ext)-1];
        }
 
        print(getExt('http://www.sina.com.cn/abc/de/fg.html.php?id=1'));
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

    default:
        echo "思路：​";
        // 遍历一个文件下的所有文件和子文件夹
        function my_scandir($dir)
        {
            $files = array();
            if($handle = opendir($dir))
            {
                while (($file = readdir($handle))!== false) 
                {
                    if($file != '..' && $file != '.')
                    {
                        if(is_dir($dir."/".$file))
                        {
                            $files[$file]=my_scandir($dir."/".$file);
                        }
                        else
                        {
                            $files[] = $file;
                        }
                    }
                }
                closedir($handle);
                return $files;
            }
        }
        var_dump(my_scandir('../'));

        break;
}
?>
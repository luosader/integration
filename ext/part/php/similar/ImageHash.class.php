<?php    
/**   
* 图片相似度比较   
* 图片相似搜索的简单原理
根据文章里的描述，其实原理比较简单，大致有如下几个步骤：
1、缩小尺寸。将图片缩小到8×8的尺寸，总共64个像素。这一步的作用是去除图片的细节，只保留结构、明暗等基本信息，摒弃不同尺寸、比例带来的图片差异。
2、简化色彩。将缩小后的图片，转为64级灰度。也就是说，所有像素点总共只有64种颜色。
3、计算平均值。计算所有64个像素的灰度平均值。
4、比较像素的灰度。将每个像素的灰度，与平均值进行比较。大于或等于平均值，记为1；小于平均值，记为0。
5、计算哈希值。将上一步的比较结果，组合在一起，就构成了一个64位的整数，这就是这张图片的指纹。组合的次序并不重要，只要保证所有图片都采用同样次序就行了。得到指纹以后，就可以对比不同的图片，看看64位中有多少位是不一样的。
这种算法的优点是简单快速，不受图片大小缩放的影响，缺点是图片的内容不能变更。实际应用中，往往采用更强大的pHash算法和SIFT算法，它们能够识别图片的变形。只要变形程度不超过25%，它们就能匹配原图。
*   
* @version     $Id: ImageHash.php 4429 2012-04-17 13:20:31Z jax $   
* @author      jax.hu   
*   
* <code>   
*  //Sample_1   
*  $aHash = ImageHash::hashImageFile('wsz.11.jpg');   
*  $bHash = ImageHash::hashImageFile('wsz.12.jpg');   
*  var_dump(ImageHash::isHashSimilar($aHash, $bHash));   
*   
*  //Sample_2   
*  var_dump(ImageHash::isImageFileSimilar('wsz.11.jpg', 'wsz.12.jpg'));   
* </code>   
*/    

class ImageHash {
    /**取样倍率 1~10   
    * @access public   
    * @staticvar int   
    */    
    public static $rate = 2;

    /**相似度允许值 0~64   
    * @access public   
    * @staticvar int
    */    
    public static $similarity = 80;

    /**图片类型对应的开启函数   
    * @access private   
    * @staticvar string   
    * */    
    private static $_createFunc = array(
            IMAGETYPE_GIF   =>'imageCreateFromGIF',
            IMAGETYPE_JPEG  =>'imageCreateFromJPEG',
            IMAGETYPE_PNG   =>'imageCreateFromPNG',
            IMAGETYPE_BMP   =>'imageCreateFromBMP',
            IMAGETYPE_WBMP  =>'imageCreateFromWBMP',
            IMAGETYPE_XBM   =>'imageCreateFromXBM',
        );


    /**从文件建立图片   
    * @param string $filePath 文件地址路径   
    * @return resource 当成功开启图片则传递图片 resource ID，失败则是 false   
    * */    
    public static function createImage($filePath){ 
        if(!file_exists($filePath)){ return false; }

        /*判断文件类型是否可以开启*/    
        $type = exif_imagetype($filePath);
        if(!array_key_exists($type,self::$_createFunc)){ return false; }

        $func = self::$_createFunc[$type];
        if(!function_exists($func)){ return false; }

        return $func($filePath);
    }


    /**hash 图片   
    * @param resource $src 图片 resource ID   
    * @return string 图片 hash 值，失败则是 false   
    * */    
    public static function hashImage($src){ 
        if(!$src){ return false; }

        /*缩小图片尺寸*/    
        $delta = 8 * self::$rate;
        $img = imageCreateTrueColor($delta,$delta);
        imageCopyResized($img,$src, 0,0,0,0, $delta,$delta,imagesX($src),imagesY($src));

        /*计算图片灰阶值*/    
        $grayArray = array();
        for ($y=0; $y<$delta; $y++){ 
            for ($x=0; $x<$delta; $x++){ 
                $rgb = imagecolorat($img,$x,$y);
                $col = imagecolorsforindex($img, $rgb);
                $gray = intval(($col['red']+$col['green']+$col['blue'])/3)& 0xFF;

                $grayArray[] = $gray;
            }
        }
        imagedestroy($img);

        /*计算所有像素的灰阶平均值*/    
        $average = array_sum($grayArray)/count($grayArray);

        /*计算 hash 值*/    
        $hashStr = '';
        foreach ($grayArray as $gray){ 
            $hashStr .= ($gray>=$average) ? '1' : '0';
        }

        return $hashStr;
    }


    /**hash 图片文件   
    * @param string $filePath 文件地址路径   
    * @return string 图片 hash 值，失败则是 false   
    * */    
    public static function hashImageFile($filePath){ 
        $src = self::createImage($filePath);
        $hashStr = self::hashImage($src);
        imagedestroy($src);

        return $hashStr;
    }


    /**比较两个 hash 值，是不是相似   
    * @param string $aHash A图片的 hash 值   
    * @param string $bHash B图片的 hash 值   
    * @return bool 当图片相似则传递 true，否则是 false   
    * */    
    public static function isHashSimilar($aHash, $bHash){ 
        $aL = strlen($aHash); $bL = strlen($bHash);
        if ($aL !== $bL){ return false; }

        /*计算容许落差的数量*/    
        $allowGap = $aL*(100-self::$similarity)/100;

        /*计算两个 hash 值的汉明距离*/    
        $distance = 0;
        for($i=0; $i<$aL; $i++){ 
            if ($aHash{$i} !== $bHash{$i}){ $distance++; }
        }

        return ($distance<=$allowGap) ? true : false;
    }


    /**比较两个图片文件，是不是相似   
    * @param string $aHash A图片的路径   
    * @param string $bHash B图片的路径   
    * @return bool 当图片相似则传递 true，否则是 false   
    * */    
    public static function isImageFileSimilar($aPath, $bPath){ 
        $aHash = ImageHash::hashImageFile($aPath);
        $bHash = ImageHash::hashImageFile($bPath);
        return ImageHash::isHashSimilar($aHash, $bHash);
    }

}
?>
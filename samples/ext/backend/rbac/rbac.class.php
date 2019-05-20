<?php 
/**
* RBAC
*/
$rbac_role = array();
$rbac_module = array('sys');

class RBAC extends Base
{
    public $oop;
    const guest = 1;

    function __construct()
    {
        
    }

    public function __access_check($rule='user')
    {
        global $db;
        //登录者
        $uid = $_SESSION["uid"];

        //根据用户名查角色
        $sql = "select jueseid from qx_uij where useid='{$uid}'";
        $query = $db->query($sql);
        $ajs = $query->fetch_all();

        //定义一个存放功能代号的数组
        $arr = array();
        //根据角色代号查功能代号
        foreach($ajs as $vjs) {
            $jsid = $vjs[0]; //角色代号
            $sql = "select ruleid from qx_jwr where jueseid='{$jsid}'";
            $r = $db->query($sql);
            $attr = $r->fetch_all();
            $str = '';
            foreach($attr as $v) {
                $str .= implode('^',$v).'|';
                // $str .= $str?'|'.implode('^', $v):implode('^', $v);// 不建议在循环体内做判断
            }
            $strgn = substr($str,0,strlen($str)-1);// 删掉最后一个 '|'

            $agn = explode('|',$strgn);
            foreach($agn as $vgn) {
                array_push($arr,$vgn);
            }    
        }

        //去重，显示
        $arr = array_unique($arr);
        // debug($arr,1);
        foreach($arr as $v) {
            $sql = "select code,name from qx_rules where code='{$v}'";
            $r = $db->query($sql);
            // $attr = $r->fetch_all();
            $attr = $r->fetch_all(MYSQL_ASSOC);
            // $attr_code = iconv('gb2312', 'utf-8', $attr[0][0]);
            // $attr_name = iconv('gb2312', 'utf-8', $attr[0][1]);
            foreach ($attr as $val) {
                $val['name'] = iconv('gb2312','utf-8',$val['name']);
                $rules[] = $val;
            }
        }
        // debug($rules,1);
        return $rules;
    }
}
?>
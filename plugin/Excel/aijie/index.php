<?php
define('IN_DOUCO', true);

// 强制在移动端中显示PC版
if (isset($_REQUEST['mobile'])) {
    setcookie('client', 'pc');
    if ($_COOKIE['client'] != 'pc') $_COOKIE['client'] = 'pc';
}

if (isset($_COOKIE['user_id'])) {
    $_USER = array('user_id'=>$_COOKIE['user_id'],'user_name'=>$_COOKIE['uname']);
}
require (dirname(__FILE__) . '/include/init.php');
require (ROOT_PATH . 'public.php');

// 未登录时跳转
// if (!$_USER) {
//     $dou->dou_header('user.php');
// }

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : '';
$is_news_page = '';

// 接口数据调用
switch ($rec) {
case 'ajaxright':
$id = $check->is_number($_POST['id']) ? $_POST['id'] : 0;
$pro = $dou->fetchRow("SELECT id,name,price,url,resource FROM ".$dou->table('product')." WHERE id=".$id);
$uexp = $dou->get_one("SELECT exp FROM ".$dou->table('user')." WHERE user_id=".$_USER['user_id']);
$where = $dou->rank_exp($uexp,'where');
$disabled = ($where==1)?'':'disabled';

$temp = explode(';', $pro['resource']);
$ziduan = $ziduan_sel = '';
foreach ($temp as $k => $v) {
    $resource[] = explode(':',$v);
    $ziduan .= <<<EOT
        <div class="col-md-6">
            <div class="checkbox" style="margin: 0px 0px 5px;">
                <label>
                    <input class="field" name="Scode[]" value="{$resource[$k][1]}" type="checkbox">
                    <span class="checkbox-material">
                        <span class="check"></span>
                    </span>
                    {$resource[$k][0]}
                </label>
            </div>
        </div>
EOT;
    $ziduan_sel .= '<option class="bs-title-option" value="'.$resource[$k][1].'">'.$resource[$k][0].'</option>';
}

$html = <<<ORZ
<form>
    <div class="panel-body">
        <div class="md-sub-header">
            步骤1 : 选择字段名
        </div>
        <div class="WIZARD_STEP3_TOP">
            <a href="javascript:void(0);" field="0" class="btn">选择全部字段</a>
            <a href="index.php?rec=downfields&id={$id}" target="_blank">下载中文字段说明&nbsp; &nbsp;</a>
        </div>

        <div class="row">
        	{$ziduan}
        </div>

        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <div class="panel-body">
        <div class="md-sub-header">
            步骤2 : 条件描述（非必选）
        </div>
        <table class="table table-striped table-hover ">
            <thead>
                <tr>
                    <th>字段名</th>
                    <th>操作</th>
                    <th>值</th>
                    <th>关系</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr class="disableTr">
                    <td>
                        <select name="step2_field[]" {$disabled}>
                            <option class="bs-title-option" value="">选择一个字段名</option>
                            {$ziduan_sel}
                        </select>
                    </td>
                    <td>
                        <select name="step2_operator[]"  class="selectpicker" {$disabled}>
                            <option value="=" selected>等于</option>
                            <option value="!=">不等于</option>
                            <option value=">">大于</option>
                            <option value="<">小于</option>
                            <option value=">=">不小于</option>
                            <option value="<=">不大于</option>
                            <option value="in">包含</option>
                            <option value="not in">不包含</option>
                            <option value="like">存在</option>
                            <option value="not like">不存在</option>
                        </select>
                    </td>
                    <td>
                        <input name="step2_value[]" type="text" class="form-control" {$disabled}>
                    </td>
                    <td>
                        <select name="step2_relation[]" class="selectpicker" {$disabled}>
                            <option value="or">OR</option>
                            <option value="and" selected>AND</option>
                        </select>
                    </td>

                    <td>
                        <img class="STEP4_TABLE_HEAD_Operate_img" style="cursor:pointer;" src="theme/default/images/add.png">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="id" value="{$id}" />
</form>

<div class="divider"></div>

<div class="panel-body">
    <div class="md-sub-header">
        步骤3 : 预览/下载
    </div>
    <div id="mypreview">
        <div class="pre_view"></div>
        <div style="width:33%;float:left;">
            <div style="text-align:center;margin-top:50px;"><a href="javascript:void(0)" class="btn Preview">预览（ {$_CFG[preview_num]} 行）</a></div>
        </div>
    </div>
    <div style="width:33%;float:left;">
        <a style="margin-top:60px;" class="btn" id="collect" demon="{$id}">收 藏</a>
    </div>
    <div style="width: 33%; float: right;">
        <div style="text-align: center; margin-top: 50px;">
            <select name="outfileType" class="selectpicker" id="selectDown" data-size="5" tabindex="-98">
                <option value="Xlsx" selected="">Excel表格</option>
                <option value="Csv">逗号分隔值文件CSV</option>
                <option value="Txt">文本文件TXT</option>
            </select>
            <a style="margin-left: 30px;" class="btn Download" price="{$pro[price]}">下 载</a>
        </div>
    </div>
</div>
ORZ;
    echo $html;exit;
    break;

case 'preview':
    if (empty($_USER['user_id'])) {echo 'login';exit;}
    $id = $check->is_number($_POST['id']) ? $_POST['id'] : 0;
    if (!$id) { $dou->dou_msg('参数丢失', ROOT_URL,3,true); }

    if ($_CFG['rank_status']) {
        $user_info = $dou->fetchRow("SELECT `exp`,`money` FROM ".$dou->table('user')." WHERE user_id=".$_USER['user_id']);
        $search = $dou->rank_exp($user_info['exp'],'search');// 预览次数
        $resall = $dou->get_one("SELECT count(*) FROM ".$dou->table('user_log')." WHERE type='preview' AND uid=".$_USER['user_id']);
        $res = $dou->get_one("SELECT count(*) FROM ".$dou->table('user_log')." WHERE tid=$id AND type='preview' AND uid=".$_USER['user_id']);
        $rankexp_query = $_CFG['rankexp_query'] ? $_CFG['rankexp_query'] : 0;
        $exp = $user_info['exp']+$rankexp_query;

        if ($search<$resall) {
            echo "over";exit;
        } else {
            // $dou->query("REPLACE INTO ".$dou->table('user_log')."(type,brief,uid,tid,ip,addtime) VALUES() ");
            if (!$res) {
                $data = array(
                        'type'      => 'preview',
                        'brief'     => '预览',
                        'exp'       => $_CFG['rankexp_query'],
                        'uid'       => $_USER['user_id'],
                        'tid'       => $id,
                        'ip'        => $dou->get_ip(),
                        'addtime'   => time()
                    );
                $insert_id = $dou->insert('user_log',$data);
                if (!$insert_id) {
                   echo 'insert';exit;
                }
                $renum = $dou->update('user', array('exp'=>$exp), " user_id='$_USER[user_id]' ");
                // if (!$renum) {
                //     echo 'update';exit;
                // }
            }
        }
    }
    else { echo "close";exit; }

    $Scode = (array)$_POST['Scode'];

    // $where ='';
    // if ($_POST['step4_field'] && $_POST['step4_value'] && $_POST['step4_operator']) {
    //     $where = $_POST['step4_field'].'[]'.$_POST['step4_value'].'[]'.$_POST['step4_operator'];
    // }

    if ($_POST['step2_field']) {
    	$where['f'] = $_POST['step2_field'];
    	$where['o'] = $_POST['step2_operator'];
    	$where['v'] = $_POST['step2_value'];
    	$where['r'] = $_POST['step2_relation'];
    }

    $html = $dou->api_preview($id, $Scode, $_CFG['preview_num'], $where);

    // print_r($_POST['tj']);
    // echo json_encode($_POST);
    // print_r($html);
    echo $html;
    exit;
    break;

case 'collect':
    if (empty($_USER['user_id'])) {echo 'error1';exit;}

    $id = $check->is_number($_POST['id']) ? $_POST['id'] : 0;
    if (!$id) {echo 'error2';exit;}
    $res = $dou->get_one("SELECT count(*) FROM ".$dou->table('user_log')." WHERE tid=$id AND type='collect' AND uid=".$_USER['user_id']);
    if ($res) { echo 'error3';exit; }
    
    $data = array(
            'type'      => 'collect',
            'brief'     => '收藏',
            'uid'       => $_USER['user_id'],
            'tid'       => $id,
            'ip'        => $dou->get_ip(),
            'addtime'   => time()
        );
    $insert_id = $dou->insert('user_log',$data);
    if ($insert_id) {
       echo $insert_id;exit;
    } else {
        echo 'error4';exit;
    }
    break;

case 'downfields':
    $id = $check->is_number($_GET['id']) ? $_GET['id'] : 0;
    if ($id) {
        $pro = $dou->fetchRow("SELECT name,resource FROM ".$dou->table('product')." WHERE id=".$id);
        $file_size = mb_strlen($pro['resource']);
        $resource = str_replace(';', "\r\n", $pro['resource']);
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length:".$file_size);
        Header("Content-Disposition: attachment; filename=".$pro['name'].".txt");
        echo $resource;
    } else {
        $dou->dou_msg('参数丢失', ROOT_URL,3,true);
    }
    exit;
    break;

case 'downfile':
    if (empty($_USER['user_id'])) {echo 'error1';exit;}

    $id = $check->is_number($_POST['id']) ? $_POST['id'] : '';
    $sel = $check->is_extend_id($_POST['sel']) ? $_POST['sel'] : '';
    $Scode = $_POST['Scode'] ? $_POST['Scode'] : '';
    // $tj = $_POST['tj'] ? $_POST['tj'] : '';
    if ($_POST['step2_field']) {
        $where['f'] = $_POST['step2_field'];
        $where['o'] = $_POST['step2_operator'];
        $where['v'] = $_POST['step2_value'];
        $where['r'] = $_POST['step2_relation'];
    }

    if (empty($id)) { echo 'error2';exit; }
    if (empty($sel)) { echo 'error2';exit; }
    if (empty($Scode)) { echo 'error3';exit; }

    $data['id'] = $id;
    $data['sel'] = $sel;
    $data['Scode'] = $Scode;
    // $data['tj'] = $tj;
    $data['where'] = $where;

    echo json_encode($data);
    exit;
    break;

case 'downfile_ac':
    $data = $_GET['data'] ? $_GET['data']: '';
    $data = json_decode(stripcslashes($data));
    $sel = $data->sel;
    $id = $data->id;
    $Scode = $data->Scode;
    // $tj = $data->tj;
    $where = $data->where;

    // if ($_CFG['rank_status']) {
        $user_info = $dou->fetchRow("SELECT `exp`,`money` FROM ".$dou->table('user')." WHERE user_id=".$_USER['user_id']);
        $down = $dou->rank_exp($user_info['exp'],'down');// 下载次数
        // $resall = $dou->get_one("SELECT count(*) FROM ".$dou->table('user_log')." WHERE type='down' AND uid=".$_USER['user_id']);
        // if ($down<=$resall) {
        //     $dou->dou_msg('已超过最大下载次数！','/',3,true);
        // }
        $TXT = excel_api_list($id, $Scode, $down, $where);
        $res = $dou->get_one("SELECT count(*) FROM ".$dou->table('user_log')." WHERE tid=$id AND type='down' AND uid=".$_USER['user_id']);
        if (!$res) {
            $last_login = time();
            $last_ip = $dou->get_ip();
            $TXT['price'] = $TXT['price']?$TXT['price']:0;
            $money  = $user_info['money'] - $TXT['price'];
            $rankexp_down = $_CFG['rankexp_down'] ? $_CFG['rankexp_down']:0;
            $exp    = $user_info['exp']+$rankexp_down;
            $data = array( 'money'=>$money, 'exp'=>$exp );
            try
            {
                if ($money<0) {
                    throw new Exception('用户余额不足！');
                }
                if ($money || $exp!=$user_info['exp']) {
                    $renum = $dou->update('user',$data," user_id='$_USER[user_id]' ");
                    if (!$renum) {
                        throw new Exception('用户余额扣除失败！');
                    }
                }
                $data = array(
                        'type'      => 'down',
                        'brief'     => '下载',
                        'exp'       => $rankexp_down,
                        'cos'       => -$TXT['price'],
                        'uid'       => $_USER['user_id'],
                        'tid'       => $id,
                        'ip'        => $last_ip,
                        'addtime'   => $last_login
                    );
                $insert_id = $dou->insert('user_log',$data);
                if (!$insert_id) {
                   throw new Exception('用户下载记录添加失败！');
                }
            }
            catch(Exception $e)
            {
                $dou->dou_msg($e->getMessage(),'/',3,true);
            }
        }
    // }

    if ($sel=='Xlsx') {
        // Windows操作系统中，文件名是不区分大小写的；而Linux系统是大小写敏感。
        // $excel_file = ROOT_PATH . 'admin/include/phpexcel/excel.class.php';
    	// $excel_file = ROOT_URL . 'admin/include/phpexcel/excel.class.php';
    	$excel_file = 'admin/include/PHPExcel/excel.class.php';
        // die($excel_file);
        if (file_exists($excel_file)) {
            include_once $excel_file;
            $excel = new Excel();
        }else{ 
            $dou->dou_msg('Excel类库不存在！',ROOT_URL,3,true);
        }
        $excel->export_excel('api', $TXT);exit;
    } elseif ($sel=='Csv') {
        $head = '';
        foreach ($TXT['head'] as $k => $v) {
            if ($k==0) { $head .= $v; } else { $head .= ','.$v; }
        }
        foreach ($TXT['list'] as $key => $value) {
            foreach ($value as $k => $v) {
                if ($k==0) { $list .= $v; } else { $list .= ','.$v; }
            }
            $list .= "\r\n";
        }
        $list = $head."\r\n".$list;
        // fputcsv($file,split(',',$line));
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Content-Disposition: attachment; filename=".$TXT['title'].".csv");
        echo $list;exit;
    } elseif ($sel=='Txt') {
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        // Header("Accept-Length:".$file_size);
        Header("Content-Disposition: attachment; filename=".$TXT['title'].".txt");
        print_r($TXT);exit;
    }
    break;

case 'guestbook':
    $op = $check->is_rec($_POST['op']) ? $_POST['op'] : '';
    $id = $check->is_number($_POST['id']) ? $_POST['id'] : '';
    if (empty($op)) { if($op=='contact'){$wrong['success']=0; $wrong['status']='op';echo json_encode($wrong);exit;}else{echo 'op';exit;}}
    if (empty($_USER['user_id'])) { if($op=='contact'){$wrong['success']=0; $wrong['status']='uid';echo json_encode($wrong);exit;}else{echo 'uid';exit;} }
    if ($op=='contact') {
        # name extend_tel extend_email content
        if (!$_POST['name'] || !$_POST['content']) {
            $wrong['success']=0;
            $wrong['status']='nameAndmessage';
        }
        if (!$_POST['extend_tel'] || !$_POST['extend_email']) {
            $wrong['success']=0;
            $wrong['status']='phoneAndemail';
        }
        if (!$check->is_telphone(trim($_POST['extend_tel']))) {
            $wrong['success']=0;
            $wrong['status']='phoneerror';
        }
        if (!$check->is_email(trim($_POST['extend_email']))) {
            $wrong['success']=0;
            $wrong['status']='mailerror';
        }
        if($wrong){echo json_encode($wrong);exit;}
    }

    if ($_POST['extend_email']) {
        $contact_type = 'email';
        $contact = $_POST['extend_email'];
    } else {
        if ($_POST['extend_tel']) {
            $contact_type = 'tel';
            $contact = $_POST['extend_tel'];
        } else {
            $contact_type = $contact = '';
        }
    }

    $extend = serialize($_POST);
    $data = array(
            'uid'      => $_USER['user_id'],
            'title'     => $_POST['title'],
            'name'      => $_POST['name'],
            'content'   => $_POST['content'],
            'extend'    => $extend,
            'type'      => $_POST['op'],
            'contact_type' => $contact_type,
            'contact'   => $contact,
            'ip'        => $dou->get_ip(),
            'add_time'  => time()
        );

    if ($id) {
        $affected = $dou->update('guestbook',$data,' id='.$id);
    } else {
        $affected = $dou->insert('guestbook',$data);
    }
    
    if ($affected) {
        if ($op=='contact') {
            $wrong['success']=1;
            $wrong['status']='success';
            echo json_encode($wrong);exit;
        }
        echo 'success';exit;
    } else {
        if ($op=='contact') {
            $wrong['success']=0;
            $wrong['status']='error';
            echo json_encode($wrong);exit;
        }
        echo 'error';exit;
    }
    break;
}



// var_dump($_USER);



/*
 * 搜索处理
 * 字段预处理
 * 获取数据并拼接
 * 返回json数据
*/
$gkey = $_POST['gkey'] ? trim($_POST['gkey']): '';
$gword = $_POST['gword'] ? trim($_POST['gword']): '';
$gwhere = '';
if ($gkey=='table') {
    $gwhere .= $gword?" url LIKE '%$gword%' ":'';
} elseif ($gkey=='fields') {
    $gwhere .= $gword?" resource LIKE '%$gword%' ":'';
} elseif ($gkey=='all') {
    $gwhere .= $gword?" (name LIKE '%$gword%' OR url LIKE '%$gword%' OR resource LIKE '%$gword%') ":'';
}

$exp = $dou->get_one("SELECT exp FROM ".$dou->table('user')." WHERE user_id=".$_USER['user_id']);
$data = $dou->rank_exp($exp,'data');
if (!empty($data)) {
    $datas = explode('&',$data);
    $pid = $datas[0]?unserialize($datas[0]):array();
    $cid = $datas[1]?unserialize($datas[1]):array();
    $did = $datas[2]?unserialize($datas[2]):array();
} else {
    $datas = $pid = $cid = $did = array();
}
// print_r($pid);
$ghtml = '';
// 返回搜索ajax数据
// if($gword){
    // 获取顶级id
    function getpids($gcid,&$pids,$pid){
        $child = $GLOBALS['dou']->fetchRow("SELECT parent_id FROM ".$GLOBALS['dou']->table('product_category')." WHERE cat_id=".$gcid);
        if($child['parent_id']!=0){
            getpids($child['parent_id'],$pids,$pid);
        }else{
            if (in_array($gcid,$pid)) {
                $pids[] = $gcid;
            }
        }
    }

    $gwherefirst = $gwhere ? ' WHERE '.$gwhere: '';
    $prolist = $dou->fetchAll("SELECT cat_id FROM ".$dou->table('product').$gwherefirst);
    $cids = array();
    foreach ($prolist as $v) {
        if (in_array($v['cat_id'],$cid)) {
            $cids[] = $v['cat_id'];
        }
    }
    $cids = (array)array_unique($cids);
    $pids = array();
    foreach ($cids as $v) {
        getpids($v,$pids,$pid);
    }
    $pids = (array)array_unique($pids);
// print_r($pids);
    $gwheresecond = $gwhere ? ' AND '.$gwhere: '';
    $procate_list = array();
    foreach ($pids as $k => $v) {
        // echo $v.'<br>';
        $cat_name = $dou->get_one("SELECT cat_name FROM ".$dou->table('product_category')." WHERE cat_id=".$v);
        if (in_array($v,$pid)) {
            // $procate_list[$k]['cat_id'] = $v;
            $procate_list[$k]['cat_name'] = $cat_name;
            $ghtml .= '<div class="user"><p>'.$cat_name.'</p><ul>';
            $childlist = $dou->fetchAll("SELECT cat_id,cat_name FROM ".$dou->table('product_category')." WHERE parent_id=".$v);
            if ($childlist) {
                foreach ($childlist as $ke => $va) {
                    if (in_array($va['cat_id'],$cids) && in_array($va['cat_id'],$cid)) {
                        $procate_list[$k]['child'][$ke] = $va;
                        $ghtml .= '<li>'.$va['cat_name'].'<ul>';
                        $prolist = $dou->fetchAll("SELECT id,cat_id,name FROM ".$dou->table('product')." WHERE cat_id=".$va['cat_id'].$gwheresecond);
                        foreach ($prolist as $key => $val) {
                            if (in_array($val['id'],$did)) {
                                $procate_list[$k]['child'][$ke]['product'][$key] = $val;
                                // echo "$v-".$va['cat_id']."-".$val['id'];
                                $ghtml .= '<li master="'.$val['id'].'">'.$val['name'].'</li>';
                            }
                        }
                        $ghtml .= '</ul></li>';
                    }
                }
            }
            $ghtml .= '</ul></div>';
        }
    }
    if ($gkey) {
        $jsdata = array('on'=> 0,'ghtml'=>$ghtml);
        echo json_encode($jsdata);exit;
    }
    // print_r($procate_list);
    // die;

/*} else {
    // 处理列表数据
    $procate_list = $dou->get_category('product_category');
    // print_r($procate_list);
    foreach ($procate_list as $key => $val) {
        if (in_array($val['cat_id'],$pid)) {
            $ghtml .= '<div class="user"><p>'.$val['cat_name'].'</p><ul>';
            if (is_array($val['child'])) {
                foreach ($val['child'] as $k => $v) {
                    if (in_array($v['cat_id'],$cid)) {
                        $ghtml .= '<li>'.$v['cat_name'].'<ul>';
                        $pro = $dou->fetchAll("SELECT id,name FROM ".$dou->table('product')." WHERE cat_id=".$v['cat_id']);
                        if ($pro) {
                            foreach ($pro as $ke => $va) {
                                if (in_array($va['id'],$did)) {
                                    $ghtml .= '<li master="'.$va['id'].'">'.$va['name'].'</li>';
                                    $procate_list[$key]['child'][$k]['product'][$ke] = $va;
                                }
                            }
                        }
                        $ghtml .= '</ul></li>';
                    } else { $procate_list[$key]['child'][$k] = ''; }
                }
            }
            $ghtml .= '</ul></div>';
        } else { $procate_list[$key] = ''; }
    }
    if ($gkey) {
        $jsdata = array('on'=> 1,'ghtml'=>$ghtml);
        echo json_encode($jsdata);exit;
    }
}*/



/*
 * 新闻
 * 字段预处理
 * 获取数据并拼接
 * 返回json数据
*/
// 验证并获取合法的ID，如果不合法将其设定为-1
$cat_id = $firewall->get_legal_id('article_category', $_REQUEST['id'], $_REQUEST['unique_id']);
if ($cat_id == -1) {
    $dou->dou_msg($GLOBALS['_LANG']['page_wrong'], ROOT_URL,3,true);
} else {
    $where = ' WHERE cat_id IN (' . $cat_id . $dou->dou_child_id('article_category', $cat_id) . ')';
}
// 获取分页信息
$page = $check->is_number($_REQUEST['page']) ? trim($_REQUEST['page']) : 1;
$limit = $dou->pager('article', ($_DISPLAY['article'] ? $_DISPLAY['article'] : 10), $page, '', $where);

$article_list = $dou->get_douphp_list($cat_id, $where, 'id DESC', $limit, 'id, title, cat_id, add_time, click, description');
if ($cat_id) {
    foreach ($article_list as $key => $v) {
        $html .= '<li><a class="cor666" href="'.$v['url'].'">'.$v['title'].'</a></li>';
    }
    echo $html;exit;
}

// 获取单页信息
$pagelist = $dou->fetchAll("SELECT id,unique_id,page_name,content FROM ".$dou->table('page')." ORDER BY unique_id");



// 赋值给模板-meta和title信息
$smarty->assign('page_title', $dou->page_title());
$smarty->assign('keywords', $_CFG['site_keywords']);
$smarty->assign('description', $_CFG['site_description']);

// 赋值给模板-列表数据
$smarty->assign('nav_middle_list', $dou->get_nav('middle'));
$smarty->assign('procate_list', $procate_list);
$smarty->assign('article_category', $dou->get_category('article_category', 0, $cat_id));
$smarty->assign('article_list', $article_list);
foreach ($pagelist as $v) {
    $smarty->assign('page'.$v['unique_id'], $v);
}


$smarty->display('index.dwt');






/**
 * +----------------------------------------------------------
 * 导出的接口数据
 * +----------------------------------------------------------
 * title excel标题
 * head th头信息
 * list tr信息
 * +----------------------------------------------------------
 */
function excel_api_list($id, $Scode, $limit='', $where='', $fields='&fields=') {
    $limit = $limit ? '&top='.$limit : '&top=20';

    /* if (!empty($where)) {
        $tj = '';
        foreach ($where as $v) {
            if ($v) {
                $tj .= stripcslashes($v);
            }
        }
        // $tj = strrev($tj);
        $where = $tj ? '&where='.substr($tj,0,-3) : '';
    } */
    if ($where) {
        $where = (array)$where;
        // $last = count($where['r']);
        $wh = array();
        foreach ($where['f'] as $k => $v) {
            if ($v) {
                $wh[$k] = $v.' ';
            }
        }
        foreach ($where['o'] as $k => $v) {
            if ($wh[$k]) {
                $wh[$k].= $v.' ';
            }
        }
        foreach ($where['v'] as $k => $v) {
            if ($v) {
                if (is_numeric($v)) {
                    $wh[$k].= $v.' ';
                } elseif (strpos('^'.$wh[$k],' like')) {
                    $wh[$k].= "'%".$v."%' ";
                } elseif (strpos('^'.$wh[$k],' in')) {
                    $wh[$k].= '('.$v.') ';
                } else {
                    $wh[$k].= '\''.$v.'\' ';
                }
            }
        }
        foreach ($where['r'] as $k => $v) {
            if ($wh[$k]) {
                $wh[$k].= $v.' ';
            }
        }
        krsort($wh);
    }
    $where = '';
    foreach ($wh as $val) {
        $where .= $val;
    }
    $where = $where ? '&where='.substr($where,0,-4) : '';
    // return $where;
    
    $proinfo = $GLOBALS['dou']->fetchRow("SELECT name,price,url,resource FROM ".$GLOBALS['dou']->table('product')." WHERE id=".$id);
    $excel_list['title'] = $proinfo['name'];
    $excel_list['price'] = $proinfo['price'];
    foreach ((array)$Scode as $k => $v) {
        $key = $GLOBALS['dou']->apiresource($proinfo['resource'],$v,'key');
        // 导出的字段名称,生成表格标题栏内容
        $excel_list['head'][] = $key;
        if ($k==0) {
            $fields .= $v;
        } else {
            $fields .= ','.$v;
        }
    }

    $url = $proinfo['url'].$limit.$fields.$where;
    $url = str_replace(' ','%20',$url);
    $data = file_get_contents($url);

    // 处理json数据
    $json = $GLOBALS['dou']->obj_arr(json_decode($data));

    // 导出列表
    foreach ($json as $v) {
        foreach ($v as $key => $val) {
            $excel_list['list'][] = array_values($val);
        }
    }
    return $excel_list;
}
    
// 获取所有父级id
// function getpids($gcid,&$data,$dou){
// function getpids($gcid){
//     $child = $GLOBALS['dou']->fetchRow("SELECT parent_id FROM ".$GLOBALS['dou']->table('product_category')." WHERE cat_id=".$gcid);
//     if($child['parent_id']!=0){
//         getpids($child['parent_id']);
//     }else{
//         $pids[] = $gcid;
//     }
//     return $pids;
// }

?>
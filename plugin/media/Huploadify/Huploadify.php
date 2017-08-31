<?php 
function IdOneFile($filepath, $file_name, $obj_id, $gUid, $gUsername, $obj_type='task')
{
    if ($filepath) {
        $filepath = explode(',', $filepath);
        $filepathcount = count($filepath);
        $filepath = $filepath[$filepathcount-1];
    }
    if ($file_name) {
        $file_namecount = count($file_name);
        $file_name = $file_name[$file_namecount-1];
    }

    /*$obj_id = db_factory::get_count("SELECT record_id FROM ".TABLEPRE."witkey_auth_record WHERE auth_code='$code' AND uid=$gUid ");
    if ($obj_id) {
        $InsertID = db_factory::inserttable( TABLEPRE.'witkey_file',array('obj_type'=>'auth','obj_id'=>$obj_id,'file_name'=>$file_name,'save_name'=>$filepath,'uid'=>$gUid,'username'=>$gUsername,'on_time'=>time()) );
    }*/
    /*$sql = sprintf('INSERT INTO %switkey_file (obj_type,obj_id,file_name,save_name,uid,username,on_time) VALUES ',TABLEPRE);
    foreach ($filepath as $k => $v) {
        $strSQL .= $strSQL ? ',' : '';
        $strSQL .= '(\''. $obj_type .'\','. $obj_id .',\''. $file_name[$k] .'\',\''. $v .'\','. $gUid .',\''. $gUsername .'\','. time() .')';
    }
    $strSQL = $sql . $strSQL;
    db_factory::query($strSQL);*/

    return array('filepath'=>$filepath,'file_name'=>$file_name);
    // return 1;
}

function IdJoinFile($filepath, $file_name, $obj_id, $gUid, $gUsername, $obj_type='task')
{
    $filepath = explode(',', $filepath);
    $file_name = explode(',', $file_name);
    foreach ($filepath as $k => $v) {
        $InsertID = db_factory::inserttable( TABLEPRE.'witkey_file',array('obj_type'=>$obj_type,'obj_id'=>$obj_id,'file_name'=>$file_name[$k],'save_name'=>$v,'uid'=>$gUid,'username'=>$gUsername,'on_time'=>time()) );
        $idjoin .= $idjoin ? ','. $InsertID : $InsertID;
    }
    return $idjoin;
    // return 1;
}

function GetOneFile($idjoin)
{
    $idjoin = explode(',', $idjoin);
    $idjoin_count = count($idjoin);
    $file_id = intval($idjoin[$idjoin_count-1]);
    $filepath = db_factory::get_count("select save_name from ".TABLEPRE."witkey_file where file_id=".$file_id);
    return $filepath;
    // return 1;
}

function lo_move_uploaded_file($Filepath='',$ObjFiles,$i='')
{
    $strFilename = $ObjFiles['name'];
    if ($strFilename) {
        if (!$Filepath) {
            $Filepath = 'data/uploads/'.date('Y/m/d').'/';
        }
        $arrExname = explode('.', $strFilename);
        $strFilename = kekezu::randomkeys(25).'.'.$arrExname[1];
        $strFile = $Filepath . $strFilename;
        // return $ObjFiles['tmp_name'];
        kekezu::dir_status($strFile,true);
        move_uploaded_file($ObjFiles['tmp_name'],$strFile);
        if (file_exists($strFile)) {
            return $strFile;
        } else {
            return false;
        }
    } else {
        return false;
    } 
    // return 1;
}



$strExtTypes   = kekezu::get_ext_type();//文件上传允许类型,Huploadify.htm里用到。
$strFile_Max_size = $basic_config['max_size']*1024;// 最大单个文件上传大小，单位 KB。

// 文件上传处理
if ($Hupload) {
    $ObjFiles = $_FILES[$HfileObjName];
    $intLion = sizeof($ObjFiles['name']);
    $Hobj_type = $Hobj_type ? $Hobj_type : 'task';
    $idjoins = '';
    if ($intLion==1) {
        // 一次一个文件
        $filepath = lo_move_uploaded_file($Hfilepath, $ObjFiles);
        if (empty($His_single)) {
            $idjoins = IdJoinFile($filepath, $ObjFiles['name'], $Hobj_id, $gUid, $gUsername, $Hobj_type);
        }
    } else {
        // 一次性传多个文件
        for ($i=0; $i <= $intLion; $i++) {
            // $strFilename = $ObjFiles['name'][$i];
            $filepath = lo_move_uploaded_file($Hfilepath, $ObjFiles, $i);// 这个只使用与一个文件
            if (empty($His_single)) {
                $idjoin = IdJoinFile($filepath, $ObjFiles['name'][$i], $Hobj_id, $gUid, $gUsername, $Hobj_type);
                $idjoins .= $idjoins ? ','.$idjoin : $idjoin;
            }
        }
    }
    $result = $idjoins ? $idjoins : $filepath;
    echo $result;
    exit();
}
?>
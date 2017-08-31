<?php 
    header('Content-Type:text/html;charset=UTF-8');
    require_once 'config.php';
    $sql = "select * from qx_user";
    $result = $db->query($sql);
    if ($result && $result->num_rows>0) {
      while ($row=$result->fetch_assoc()) {
        $row['name'] = iconv('gb2312', 'utf-8', $row['name']);
        $arr[] = $row;
      }
    }
    // print_r($arr);

    $sql = "select * from qx_juese";
    $result = $db->query($sql);
    if ($result && $result->num_rows>0) {
      while ($row=$result->fetch_assoc()) {
        $row['name'] = iconv('gb2312', 'utf-8', $row['name']);
        $ajs[] = $row;
      }
    }
    // print_r($ajs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>RBAC权限管理</title>
    <!-- <script src="<?php //echo OPJS ?>jquery-1.11.3.min.js"></script> -->
    <script src="jquery-1.11.3.min.js"></script>
</head>

<body>
    <h1>RBAC权限管理：</h1>
    <div>
        请选择用户：
        <select id="selthis">
            <?php foreach((array)$arr as $v) : ?>
            <option value="<?php echo $v['uid'] ?>"><?php echo $v['name'] ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <br />

    <div>
        请选择角色：
        <?php foreach((array)$ajs as $v) : ?>
        <input type='checkbox' value='<?php echo $v['code'] ?>' class='ck' /><?php echo $v['name'] ?>
        <?php endforeach;?>
    </div>
    <br />

    <input type="button" value="确定" id="btn" />

<script type="text/javascript">
$(document).ready(function(e) {
    //选中默认角色
    Xuan();
    //当用户选中变化的时候，去选中相应角色
    $("#selthis").change(function(){
        Xuan();
    })
    //点击确定保存角色信息
    $("#btn").click(function(){
        var uid = $("#selthis").val();
        var juese = '';
        var ck = $(".ck");
        for(var i=0;i<ck.length;i++) {
            if(ck.eq(i).prop("checked")) {
                juese += ck.eq(i).val()+"|";
            }
        }
        juese = juese.substr(0,juese.length-1);
        $.ajax({
            url:"uij_chuli.php",
            data:{uid:uid,juese:juese,mark:2},
            type:"POST",
            dataType:"TEXT",
            success: function(data) {
                if (data) {
                    alert("保存成功！");
                } else {
                    alert("保存失败！");
                }
            }
        });
    })
});

//选中默认角色
function Xuan() {
    var uid = $("#selthis").val();
    $.ajax({
        url:"uij_chuli.php",
        data:{uid:uid,mark:1},
        type:"POST",
        dataType:"TEXT",
        success: function(data){
            var juese = data.trim().split("|");
            var ck = $(".ck");
            ck.prop("checked",false);
            for(var i=0;i<ck.length;i++) {
                if(juese.indexOf(ck.eq(i).val())>=0) {
                    ck.eq(i).prop("checked",true);
                }
            }
        }
    });
}
</script>
</body>
</html>
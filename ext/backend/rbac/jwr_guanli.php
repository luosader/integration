<?php 
    header('Content-Type:text/html;charset=UTF-8');
    require_once 'config.php';
    $sql = "select * from qx_juese";
    $result = $db->query($sql);
    if ($result && $result->num_rows>0) {
      while ($row=$result->fetch_assoc()) {
        $row['name'] = iconv('gb2312', 'utf-8', $row['name']);
        $arr[] = $row;
      }
    }
    // print_r($arr);

    $sql = "select * from qx_rules";
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
        请选择角色：
        <select id="juese">
            <?php foreach((array)$arr as $v) : ?>
            <option value="<?php echo $v['code'] ?>"><?php echo $v['name'] ?></option>
            <?php endforeach;?>
        </select>
        <input type="button" value="确定" id="btn" />
    </div>

    <br />

    <div>
        请选择功能：<br>
        <?php foreach((array)$ajs as $v) : ?>
        <input type='checkbox' value='<?php echo $v['code'] ?>' class='ck' /><?php echo $v['name'] ?>
        <br>
        <?php endforeach;?>
    </div>
    <br />


<script type="text/javascript">
$(document).ready(function(e) {
    //选中默认功能
    Xuan();
    //当角色选中变化的时候，去选中相应功能
    $("#juese").change(function(){
        Xuan();
    })
    //点击确定保存功能信息
    $("#btn").click(function(){
        var jid = $("#juese").val();
        var rule = '';
        var ck = $(".ck");
        for(var i=0;i<ck.length;i++) {
            if(ck.eq(i).prop("checked")) {
                rule += ck.eq(i).val()+"|";
            }
        }
        rule = rule.substr(0,rule.length-1);
        $.ajax({
            url:"jwr_chuli.php",
            data:{jid:jid,rule:rule,type:1},
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

//选中默认功能
function Xuan() {
    var jid = $("#juese").val();
    $.ajax({
        url:"jwr_chuli.php",
        data:{jid:jid,type:0},
        type:"POST",
        dataType:"TEXT",
        success: function(data){
            var rule = data.trim().split("|");
            var ck = $(".ck");
            ck.prop("checked",false);
            for(var i=0;i<ck.length;i++) {
                if(rule.indexOf(ck.eq(i).val())>=0) {
                    ck.eq(i).prop("checked",true);
                }
            }
        }
    });
}
</script>
</body>
</html>
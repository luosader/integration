<?php 
/*
+--------------------------------+
* __ROOT_PATH__   绝对路径到根目录
* __ROOT_HOST__   域名
* __ROOT_URL__    网址URL
* $_DPS 全局
* 
* ``是为了避免关键词冲突
+--------------------------------+
*/
// require_once 'sub/init.php';// 核心文件统一调用
$link=@mysql_connect('localhost', 'root', 'root') or die('数据库连接失败');//打开数据库,带端口localhost:8888????
mysql_set_charset('utf8');// 设置数据库编码
mysql_select_db('lol') or die('指定数据库打开失败：'.mysql_error());
require_once './../../source/init_base.php';

// $q = mysql_query("SELECT a.id,a.cat_id,a.part as `name`,a.price,a.img_url as pic,a.pdf_url as pdf,a.num_sales as downs,a.createtime as addtime,b.mfg_name,c.cat_name from ic_product as a LEFT JOIN 21ic.ic_manufacturer_lang as b ON a.mfg_id=b.mfg_id LEFT JOIN 21ic.ic_category_lang as c ON a.cat_id=c.cat_id WHERE b.lang_id=1 AND c.lang_id=1 and a.id=3231359");
// echo mysql_errno().'：'.mysql_error();
// die;
$topnav = 6;// 标识
$h_title = '数据分析';// 标题


// echo "<pre>";
$Heros = mysql_num_rows(mysql_query('SELECT hid FROM lol_hero '));
$Round = mysql_num_rows(mysql_query('SELECT id FROM lol_match '));
$sql = "SELECT count(m.id) as total,sum(m.gresult) as gresult,h.hchampion,h.hnickname,h.hcname FROM lol_match m,lol_hero h WHERE m.uhero=h.hid GROUP BY m.uhero ;";
$res = mysql_query($sql);
$total = array(); $appear = array(); $odds = array(); $kills = array(); 
while ($tmp = mysql_fetch_assoc($res)) {
    // $hchampion[] = urlencode($tmp['hchampion']);
    $hchampion[] = $tmp['hchampion'];
    $total[] = $tmp['total'];
    $appear[] = round($tmp['total']/$Round,3);
    $odds[] = round($tmp['gresult']/$tmp['total'],3);
    $arr[] = $tmp;
}

$Hcount = count($arr);// 出场总数

// $legend_data = array(urlencode('出场数'),urlencode('出场率'),urlencode('胜率'),urlencode('杀敌'));
$legend_data = array('出场数','出场率','胜率','杀敌');
// $result = array('legend_data'=>$legend_data,'hchampion'=>$hchampion,'series_data'=>array('total'=>$total,'appear'=>$appear,'odds'=>$odds,'kills'=>$kills));
$result = array('legend_data'=>$legend_data,'hchampion'=>$hchampion,'series_data'=>array($total,$appear,$odds,$kills));
$res = json_encode($result);
$res = '{"legend_data":["\u51fa\u573a\u6570","\u51fa\u573a\u7387","\u80dc\u7387","\u6740\u654c"],"hchampion":["\u4e0d\u7965\u4e4b\u5203","\u4ea1\u7075\u6218\u795e","\u517d\u7075\u884c\u8005","\u51b0\u6676\u51e4\u51f0","\u55dc\u8840\u730e\u624b","\u5723\u9524\u4e4b\u6bc5","\u5815\u843d\u5929\u4f7f","\u5927\u53d1\u660e\u5bb6","\u5ba1\u5224\u5929\u4f7f","\u5bd2\u51b0\u5c04\u624b","\u5be1\u5987\u5236\u9020\u8005","\u5fb7\u739b\u897f\u4e9a\u4e4b\u529b","\u5fb7\u90a6\u603b\u7ba1","\u6076\u9b54\u5c0f\u4e11","\u6218\u4e89\u4e4b\u738b","\u6218\u4e89\u5973\u795e","\u62ab\u7532\u9f99\u9f9f","\u63a2\u9669\u5bb6","\u65e0\u6781\u5251\u5723","\u65f6\u5149\u5b88\u62a4\u8005","\u6697\u5f71\u4e4b\u62f3","\u66ae\u5149\u4e4b\u773c","\u672b\u65e5\u4f7f\u8005","\u6b66\u5668\u5927\u5e08","\u6b87\u4e4b\u6728\u4e43\u4f0a","\u6c99\u6f20\u6b7b\u795e","\u6df1\u6e0a\u5de8\u53e3","\u70bc\u91d1\u672f\u58eb","\u7194\u5ca9\u5de8\u517d","\u725b\u5934\u914b\u957f","\u72c2\u6218\u58eb","\u72c2\u91ce\u5973\u730e\u624b","\u7329\u7ea2\u6536\u5272\u8005","\u7434\u745f\u4ed9\u5973","\u74e6\u6d1b\u5170\u4e4b\u76fe","\u761f\u75ab\u4e4b\u6e90","\u7956\u5b89\u72c2\u4eba","\u7b26\u6587\u6cd5\u5e08","\u84b8\u6c7d\u673a\u5668\u4eba","\u865a\u7a7a\u5148\u77e5","\u865a\u7a7a\u6050\u60e7","\u865a\u7a7a\u884c\u8005","\u86ee\u65cf\u4e4b\u738b","\u8d4f\u91d1\u730e\u4eba","\u8fc5\u6377\u65a5\u5019","\u90aa\u6076\u5c0f\u6cd5\u5e08","\u9152\u6876","\u98ce\u66b4\u4e4b\u6012","\u9996\u9886\u4e4b\u50b2","\u9ea6\u6797\u70ae\u624b","\u9ed1\u6697\u4e4b\u5973","\u5200\u950b\u610f\u5fd7","\u5de8\u9b54\u4e4b\u738b","\u8be1\u672f\u5996\u59ec","\u9b54\u86c7\u4e4b\u62e5","\u5fb7\u739b\u897f\u4e9a\u7687\u5b50","\u590d\u4ec7\u7130\u9b42","\u673a\u68b0\u516c\u654c","\u6c38\u6052\u68a6\u9b47","\u76f2\u50e7","\u6697\u591c\u730e\u624b","\u53d1\u6761\u9b54\u7075","\u6398\u5893\u8005","\u9f50\u5929\u5927\u5723","\u66d9\u5149\u5973\u795e","\u6cd5\u5916\u72c2\u5f92","\u8fdc\u53e4\u5deb\u7075","\u4e5d\u5c3e\u5996\u72d0","\u673a\u68b0\u5148\u9a71","\u51db\u51ac\u4e4b\u6012","\u7206\u7834\u9b3c\u624d","\u6df1\u6d77\u6cf0\u5766","\u65e0\u53cc\u5251\u59ec","\u4ed9\u7075\u5973\u5deb","\u6218\u4e89\u4e4b\u5f71","\u60e9\u6212\u4e4b\u7bad","\u8bfa\u514b\u8428\u65af\u4e4b\u624b","\u672a\u6765\u5b88\u62a4\u8005","\u8346\u68d8\u4e4b\u5174","\u768e\u6708\u5973\u795e","\u50b2\u4e4b\u8ffd\u730e\u8005","\u6697\u9ed1\u5143\u9996","\u8718\u86db\u5973\u7687","\u5524\u6f6e\u9c9b\u59ec","\u76ae\u57ce\u6267\u6cd5\u5b98","\u9b42\u9501\u5178\u72f1\u957f","\u751f\u5316\u9b54\u4eba","\u66b4\u8d70\u841d\u8389","\u75be\u98ce\u5251\u8c6a","\u865a\u7a7a\u4e4b\u773c","\u8ff7\u5931\u4e4b\u7259","\u865a\u7a7a\u9041\u5730\u517d","\u661f\u754c\u6e38\u795e","\u65f6\u95f4\u523a\u5ba2","\u6cb3\u6d41\u4e4b\u738b","\u6d77\u6d0b\u4e4b\u707e","\u6d77\u517d\u796d\u53f8","\u54e8\u5175\u4e4b\u6b87","\u6b7b\u4ea1\u9882\u5531\u7740"],"series_data":[["1","1","2","1","1","2","5","2","4","3","1","3","2","3","5","5","2","6","1","1","1","1","3","1","1","2","4","4","1","2","4","2","3","1","2","1","1","1","1","2","3","4","3","1","2","2","2","2","2","3","1","3","4","1","3","2","4","1","3","2","3","1","3","4","2","1","7","3","6","1","2","2","1","2","1","4","2","2","1","2","2","4","2","4","1","3","2","4","1","5","2","2","1","2","1","4","2","4","2"],[0.004,0.004,0.009,0.004,0.004,0.009,0.021,0.009,0.017,0.013,0.004,0.013,0.009,0.013,0.021,0.021,0.009,0.026,0.004,0.004,0.004,0.004,0.013,0.004,0.004,0.009,0.017,0.017,0.004,0.009,0.017,0.009,0.013,0.004,0.009,0.004,0.004,0.004,0.004,0.009,0.013,0.017,0.013,0.004,0.009,0.009,0.009,0.009,0.009,0.013,0.004,0.013,0.017,0.004,0.013,0.009,0.017,0.004,0.013,0.009,0.013,0.004,0.013,0.017,0.009,0.004,0.03,0.013,0.026,0.004,0.009,0.009,0.004,0.009,0.004,0.017,0.009,0.009,0.004,0.009,0.009,0.017,0.009,0.017,0.004,0.013,0.009,0.017,0.004,0.021,0.009,0.009,0.004,0.009,0.004,0.017,0.009,0.017,0.009],[1,0,0.5,0,1,1,0.6,0.5,0.25,0,0,0.667,1,0.333,0.4,0.4,1,0.167,1,1,0,0,0.333,1,1,0,0.5,0.75,0,0.5,0.5,0.5,0.667,0,0,0,0,0,1,0.5,0.667,0.5,0,0,0.5,0.5,1,0.5,0.5,0.667,1,0,0.5,0,0.667,0.5,0.25,0,0.667,0.5,0.667,0,0.667,0.75,0,0,0.429,1,0.333,1,0,1,1,0.5,0,0.25,0,0.5,0,0,1,0.25,0,0.5,0,0.333,1,0.5,1,0.4,0.5,0.5,0,0,0,0.5,0.5,0.5,0],[]]}';

// echo "<pre>";
// print_r($result);
// print_r($res);
// print_r(urldecode($res));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EChart - 数据分析</title>

    <!-- 选项卡 -->
    <script type="text/javascript" src="<?php echo ROOT_HOST . SOUR_COM ?>js/jquery.SuperSlide.js"></script>
    <!-- 日历 -->
    <script type="text/javascript" src="../laydate/laydate.js"></script>
    <!-- EChart -->
    <script type="text/javascript" src="./EChart/echarts.min.js"></script>
    <script type="text/javascript" src="./EChart/china.js"></script>
</head>

<body>
<div class="selectdate_right rt">
    <form id="form1" name="form1" method="get" action="">      
        开始时间&nbsp;<input name="starttime" type="text" id="starttime" class="inline laydate-icon"/>&nbsp;
        结束时间&nbsp;<input name="endtime" type="text" id="endtime" class="inline laydate-icon"/>
        <input type="submit"  value="分析" class="submit">
    </form>
</div>
<div>
    总共 <b><?php echo $Heros ?></b> 位英雄，尚未拥有 <b>12</b> 位。 <br>
    本次统计 <b><?php echo $Round ?></b> 场最近的比赛，出现 <b><?php echo $Hcount; ?></b> 位英雄，其中 出现 次。 <br>
    已拥有但从未出现的英雄（<b><?php echo $Heros-$Hcount-12; ?></b>位）： 。
</div>

<!-- <div class="slideTxtBox">
    <div class="hd">
        <ul><li class="on">地图</li><li class="on">柱状图</li><li class="on">饼状图</li></ul>
    </div>
    <div class="hd"><ul style="display: none;"><li><div id="china" style="height:500px;width:900px;margin:0 auto;"></div></li></ul></div>
    <div class="hd"><ul style="display: none;"><li><div id="bar" style="height:500px;width:900px;margin:0 auto;"></div></li></ul></div>
    <div class="hd"><ul><li><div id="pie" style="height:500px;width:900px;margin:0 auto;"></div></li></ul></div>
</div> -->

<div id="main" style="height:500px;width:7000;"></div>
<script type="text/javascript">
var json_data = <?php echo $res; ?>;
// alert(json_data.hchampion);

var title_text      = '折线图堆叠';
var legend_data     = json_data.legend_data;
var xAxis_data      = json_data.hchampion;
var yAxis_name      = '次数';
var series_type     = 'line';
var series_stack    = '总量';

var col_title = ""; //标题的列名,固定为第一列
var col_data = [] ; // 从第二列开始, 为值字段 , ["value","value1"];
var col_data_name =[]; // 从第二列开始, 为值字段 , ["销量","值二"];
var chart_title = new Array(); //标题数组
var chart_data  = new Array(); //值数组

//给值字段赋值
for(var k in json_data){
    if (k=='series_data') {
        for(q=0;q<json_data[k].length;q++){
            col_data.push(json_data[k][q]);
        }
    };
}

//给值字段赋值
for(var i =0;i<json_data.legend_data.length;i++){
    chart_data[i] = {
        "name": json_data.legend_data[i],
        "type":series_type,
        // stack: series_stack,
        "data": json_data.series_data[i] //[5, 20, 40, 10, 10, 20]
    };
}
// console.dir(chart_data);



var myChart = echarts.init(document.getElementById('main'));
option = {
    title: {
        text: title_text
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data:legend_data
    },
    grid: {
        left: '0.1%',
        right: '4%',
        bottom: '5%',
        containLabel: true
    },
    toolbox: {
        feature: {
            saveAsImage: {}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        axisLabel: {
            show:true,
            interval: 0, // 显示所有横轴名称
            //rotate: 45,
            // margin: 8
        },
        data: xAxis_data
    },
    yAxis: {
        name: yAxis_name,
        type: 'value',
    },
    // 右侧
    toolbox: {
        show: true,
        orient: 'vertical',
        left: 'right',
        top: 'center',
        feature: {
            dataView: {readOnly: false},
            restore: {},
            saveAsImage: {}
        }
    },
    series:chart_data
};

myChart.setOption(option); 
</script>

<script>
    //选项卡
    // jQuery(".slideTxtBox").slide( {trigger:"click" });

    //日历
    !function(){
        laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
        //laydate({elem: '#demo'});//绑定元素
    }();

    //日期范围限制
    var start = {
        elem: '#starttime',
        format: 'YYYY-MM-DD',
        max: laydate.now(-1), //设定最大日期为当前日期
        // max: '2099-06-16', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };

    var end = {
        elem: '#endtime',
        format: 'YYYY-MM-DD',
        max: laydate.now(-1),
        // max: '2099-06-16',
        istime: true,
        istoday: false,
        choose: function(datas){
            start.max = datas; //结束日选好后，充值开始日的最大日期
        }
    };

    laydate(start);
    laydate(end);
</script>
</body>
</html>
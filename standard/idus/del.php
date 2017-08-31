<?php 
include("init.php");


$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

switch ($rec) {
    case 'ajax':
        # code...
        break;
    case 'recycle':
        $res = $db->query(sprintf('UPDATE %s set `recycle`=7 WHERE id=%d','ig_article',$id));
        var_dump($res);
        // echo mysqli_affected_rows($res);
        // var_dump($res->num_rows);
        // var_dump($res->affected_rows);
        break;
    case 'file':
        # code...
        break;
    
    default:
        $res = $db->query(sprintf('DELETE %s WHERE id=%d','ig_article',$id));
        // var_dump($res->affected_rows);
        break;
}
?>


<?php include 'footer.php';?>
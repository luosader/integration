<?php 
// require_once 'file';
echo "ok";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微信扫码支付</title>
</head>
<body>
    <div>
        <form action="native.php" method="post">
            <input type="text" name="money" value="0.01" id=""><br>
            <button type="submit">扫码支付</button>
        </form>
    </div>
</body>
</html>
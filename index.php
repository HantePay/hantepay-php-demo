<?php 
require 'lib/check.php';
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
	<title>hantepay api list</title>
</head>
<body>
    <div class="container" align="center">
        <h1>Hantepay API example</h1>
        <p>This example is php code for hantepay api version v1.3, It includes the major api, please view the docs in
            <a target="_blank" href="http://docs.hantepay.cn/">http://docs.hantepay.cn/</a> first
        </p>
        <p>
    <br>
    <div class="list-group">
        <ul class="nav">
          <li><a class="list-group-item" href="example/form/securePay.php">SecurePay Request</a></li>
          <li><a class="list-group-item" href="example/form/qrCodePay.php">QrCodePay Request</a></li>
        </ul>
        </div>
    </div>
</body>

</html>
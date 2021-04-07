<?php
require_once '../../config.php';
?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../../static/css/bootstrap.min.css" rel="stylesheet">
	<title>SecurePay Request Form</title>
</head>
<body>
<div class="container">
 <h3>SecurePay Request Form</h3>
 <a href="../../index.php">Back to Home</a>
 <form action="../RequestSecurePay.php" class="form-horizontal" method="POST">
<!--  <h4>Merchant Settings (normally hidden)</h4>-->
<!--  <div class="form-group required">-->
<!--   <label for="callback_url" class="col-sm-2 control-label">Callback URL</label>-->
<!--   <div class="col-sm-10">-->
    <input type="hidden" class="form-control" name="callback_url" id="callback_url" value="<?php echo CALLBACK_URL; ?>">
<!--   </div>-->
<!--  </div>-->
<!--  <div class="form-group required">-->
<!--   <label for="ipn_url" class="col-sm-2 control-label">Notify Url</label>-->
<!--   <div class="col-sm-10">-->
    <input type="hidden" class="form-control" name="notify_url" id="notify_url" value="<?php echo IPN_URL; ?>">
<!--   </div>-->
<!--  </div>-->
<!--  <div class="form-group required">-->
<!--   <label for="token" class="col-sm-2 control-label">Nonce Str</label>-->
<!--   <div class="col-sm-10">-->
    <input type="hidden" class="form-control" name="nonce_str" id="nonce_str" value="<?php echo getRandomString(10) ?>">
<!--   </div>-->
<!--  </div>-->

<!--  <div class="form-group required">-->
<!--     <label for="token" class="col-sm-2 control-label">Time</label>-->
<!--     <div class="col-sm-10">-->
         <input type="hidden" class="form-control" name="time" id="time" value="<?php echo time() ?>">
<!--     </div>-->
<!--  </div>-->

<!--     <div class="form-group">-->
<!--         <label for="token" class="col-sm-2 control-label">Sign Type</label>-->
<!--         <div class="col-sm-10">-->
             <input type="hidden" class="form-control" name="sign_type" id="sign_type" value="MD5">
<!--         </div>-->
<!--     </div>-->


<!--  <br />-->
<!--  <h4>Customer Entered Information</h4>-->
<!--     <div class="form-group required">-->
<!--         <label for="merchant_no" class="col-sm-2 control-label">Merchant No</label>-->
<!--         <div class="col-sm-10">-->
                 <input type="hidden" class="form-control" id="merchant_no" name="merchant_no" value='1025258896' >
<!--         </div>-->
<!--     </div>-->
<!--     <div class="form-group required">-->
<!--         <label for="store_no" class="col-sm-2 control-label">Store No</label>-->
<!--         <div class="col-sm-10">-->
                 <input type="hidden" class="form-control" id="store_no" name="store_no" value='S1000043' >
<!--         </div>-->
<!--     </div>-->
  <div class="form-group required">
   <label for="payment_method" class="col-sm-2 control-label">Payment Method</label>
   <div class="col-sm-10">
    <select name="payment_method" id="payment_method" class="form-control">
     <option value='alipay' selected>alipay</option>
     <option value='wechatpay'>wechatpay</option>
    </select>
   </div>
  </div>
     
  <div class="form-group required">
   <label for="out_trade_no" class="col-sm-2 control-label">Out Trade Number</label>
   <div class="col-sm-10">
    <input type="text" class="form-control" id="out_trade_no" name="out_trade_no" value='<?php echo date("YmdHis").'-'.rand(0, 100);?>' >
   </div>
  </div>
  <div class="form-group required">
   <label for="amount" class="col-sm-2 control-label">Order Amount</label>
   <div class="col-sm-10">
    <input type="text" oninput="cleanRmbAmount()" class="form-control" id="amount" name="amount" placeholder="Amount" value="10">
   </div>
  </div>
     <div class="form-group required">
         <label for="rmb_amount" class="col-sm-2 control-label">Order Rmb Amount</label>
         <div class="col-sm-10">
             <input type="text" oninput="cleanAmount()" class="form-control" id="rmb_amount" name="rmb_amount" placeholder="Rmb Amount" value="">
         </div>
     </div>
<!--  <div class="form-group required">-->
<!--   <label for="currency" class="col-sm-2 control-label">Order Currency</label>-->
<!--   <div class="col-sm-10">-->
<!--    <select name="currency" id="currency" class="form-control">-->
<!--     <option value='USD' selected>USD</option>-->
<!--    </select>-->
<!--   </div>-->
<!--  </div>-->

     <div class="form-group required">
         <label for="body" class="col-sm-2 control-label">Order Description</label>
         <div class="col-sm-10">
             <input type="text" class="form-control" name="body" id="body" value="test" placeholder="Enter Order Description">
         </div>
     </div>
  <div class="form-group">
   <label for="terminal" class="col-sm-2 control-label">Terminal</label>
   <div class="col-sm-10">
    <select name="terminal" id="terminal" class="form-control">
     <option value='ONLINE' selected>ONLINE</option>
     <option value='WAP'>WAP</option>
    </select>
   </div>
  </div>


  <div class="form-group">
   <label for="note" class="col-sm-2 control-label">Note</label>
   <div class="col-sm-10">
    <input type="text" class="form-control" id="note" name="note" placeholder="Enter Note">
   </div>
  </div>

  <div class="form-group">
   <div class="col-sm-offset-2 col-sm-10">
    <button type="submit" class="" style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;">Submit</button>
   </div>
  </div>
 </form>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../../static/js/jquery-1.1.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../../static/js/bootstrap.min.js"></script>
<script>
    function cleanRmbAmount () {
        if ($("#amount").val()>0){
            $("#rmb_amount").val("");
            $("#rmb_amount").html("");
        }
    }
    function cleanAmount() {
        if ($("#rmb_amount").val()>0){
            $("#amount").val("");
            $("#amount").html("");
        }
    }
</script>
</body>
</html>

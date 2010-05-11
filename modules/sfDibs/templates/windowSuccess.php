<h2><?php echo __('Connecting to payment gateway') ?></h2>

<form name="payform" id="payform" method="post" action="https://payment.architrade.com/payment/start.pml">
  
  <input type="hidden" name="test" value="yes" />
  
  <input type="hidden" name="merchant" value="<?php echo sfConfig::get('app_sf_dibs_merchant_id') ?>" />
  <input type="hidden" name="lang" value="<?php echo sfConfig::get('app_sf_dibs_language_code') ?>" />
  <input type="hidden" name="orderid" value="<?php  echo $order_id ?>" />
  <input type="hidden" name="amount" value="<?php echo $amount ?>" />
  <input type="hidden" name="md5key" value="<?php echo $md5key ?>" />
  <input type="hidden" name="currency" value="<?php echo sfConfig::get('app_sf_dibs_currency_code') ?>" />
  <input type="hidden" name="callbackurl" value="http://<?php echo $_SERVER['HTTP_HOST'] ?>/<?php echo url_for('@dibs_callback') ?>" />
  <input type="hidden" name="cancelurl" value="http://<?php echo $_SERVER['HTTP_HOST'] ?>/<?php echo url_for('@dibs_cancel') ?>" />
  <input type="hidden" name="accepturl" value="http://<?php echo $_SERVER['HTTP_HOST'] ?>/<?php echo url_for('@dibs_accept') ?>" />
  
</form>
<script type="text/javascript" charset="utf-8">
  window.onload = function (evt) { document.forms[0].submit(); }
</script>
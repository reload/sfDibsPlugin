<?php

/**
 * Creates a submit button, and add attributes to the wrapping element
 *
 * @param array $attributes - HTML element attributes
 * @param string $elm - Wrapping element 
 * @return string
 * @author Hasse R. Hansen, Reload! A/S
 */
function dibs_submit_button($attributes = array(), $elm = 'div') {
  $default_elements = array(
    'id' => 'payment',
    'class' => 'paylink',
  );
  
  if (is_array($attributes) && $attributes) {
    $attributes = array_merge_recursive($attributes, $default_elements);
    foreach ($attributes as $name => $value) {
      if (is_array($value)) {
        $element_value = implode(' ', $value);
      }
      else {
        $element_value= $value;
      }
      $elements[] = $name . '="' . $element_value . '"';
    }
  }
  $string = '<' . $elm . ' ' . implode(' ', $elements) . '>'. __('Pay').'</' . $elm . '>';
  error_log(print_r($string,1));
  return $string;
}


/**
 * Creates the javascript block which submits the payment form
 *
 * @param string $a - amount 
 * @param string $oid - Order id
 * @param string $checksum - md5 checksum to prevent hacking
 * @return string
 * @author Hasse R. Hansen, Reload! A/S
 */
function dibs_js($a = 0, $oid = 0, $checksum = 0) {
  $string = "<script type=\"text/javascript\" charset=\"utf-8\">
    function popUp() {
      var newwin = window.open('" . url_for("@dibs_window?a=" . $a . "&oid=" . $oid . "&cs=" . $checksum) . "/', 'paywin', 'scrollbars,status,width=550,height=600');
      newwin.focus();    
    }
    $(function() { 
      $('#payment').bind('click', function() {
        popUp();
      });
    });
    </script>";
    
  return $string;
}

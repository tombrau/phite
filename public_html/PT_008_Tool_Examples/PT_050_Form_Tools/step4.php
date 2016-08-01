<?php 
require_once("../../tools/formtools/global/api/api.php");
$fields = ft_api_init_form_page();
$params = array(
  "submit_button" => "add",
  "next_page" => "step5.php",
  "form_data" => $_POST,
	"finalize" => true
    );
ft_api_process_form($params);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
  <title>Form Tools Demo: Registration Form</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script type="text/javascript" src="rsv.js"></script>

  <script type="text/javascript">
  function fill_fields()
  {
    document.regform.cc_name.value = "Samuel Spade";
    document.regform.cc_month.value = "09";
    document.regform.cc_year.value = "2008";
  
    document.regform.cc1.value = "1111";
    document.regform.cc2.value = "1111";
    document.regform.cc3.value = "1111";
    document.regform.cc4.value = "1111";
  
    return;
  }
  </script>
</head>
<body>

	<h1>Demo Form: <span class="form_name">Registration</span></h1>

  <p>
    For the sake of this example, the submission ID from the Form Tools submission is passed along in the 
    query string to this page - our mock external payment gateway. It could, however, be passed via 
    $_POST, depending on how the gateway interacts with your own form. Assuming the following mock 
    transaction is successful (which it always is in this demo!), the form data submitted up to this 
    point is finalized and is made visible in the client interface. Otherwise it will not appear.
  </p>
  <p>
    Note: for security reasons <b>Form Tools should never store sensitive information</b>
    such as the credit card information below. This is a mock external payment gateway page only!
  </p>
  <p>
    As before, if you don't wish to fill in all the fields, 
    <a href="javascript:fill_fields()">click here</a>. Submit the form to finish the example.
  </p>
	
  <hr size="1" />
  <br />

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td><a href="step1.php"><img src="images/trail1.jpg" border="0" /></a></td>
    <td><a href="step2.php"><img src="images/trail2b.jpg" border="0" /></a></td>
    <td><a href="step3.php"><img src="images/trail3b.jpg" border="0" /></a></td>
    <td><img src="images/trail4b.jpg" /></td>
    <td><img src="images/trail5a.jpg" /></td>
  </tr>
  </table>

<?php

if (!empty($errors))
{
  echo "<div class='error'>"
     . "Please correct the following errors, and resubmit the form:"
     . "<ul>";
 foreach ($errors as $error)
 {
   echo "<li>$error</li>";
 }
 echo "</ul></div><br />"; 
}

?>

  <form name="regform" action="<?=$_SERVER['PHP_SELF']?>" method="post">
  <input type="hidden" name="submission_id" value="<?=$_GET['id']?>" />

  <h3>PAYMENT</h3>

	<div style="width:660px">
	
  <p>  
    Please review your information below and click the "REGISTER" button at the bottom when you are 
    satisfied it is all correct.
  </p>
  
  <table class="table_1" cellpadding="2" cellspacing="1" width="100%">
  <tr>
    <td colspan="2" class="table_1_bg">
  
      <table cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td class="table_1_title">PAYMENT INFO</td>
        <td class="table_1_title" align="right"> </td>
      </tr>
      </table>
  
    </td>  
  </tr>
  <tr>
    <td>Name on Credit Card</td>
    <td class="answer"><input type="text" name="cc_name" /></td>
  </tr>
  <tr>
    <td>Expiry Date</td>
    <td class="answer"><input type="text" size="2" name="cc_month" />/<input type="text" size="4" name="cc_year" /> MM/YYYY</td>
  </tr>
  <tr>
    <td>Credit Card Number</td>
    <td class="answer">
      <input type="text" size="4" name="cc1" /><input type="text" size="4" name="cc2" /><input type="text" size="4" name="cc3" /><input type="text" size="4" name="cc4" />
    </td>
  </tr>
  </table>
  
  <br />
  
  <table class="error" style="width: 100%">
  <tr>
    <td>
      This is the final step. Once you click "REGISTER" your registration will be processed.
    </td>
    <td align="right" width="140">
      <input type="submit" value="REGISTER" name="add" style="font-weight: bold;"/>
    </td>  
  </tr>
  </table>
  
  </form>

</div>
	
</body>
</html>

<?php 
require_once("../../tools/formtools/global/api/api.php");

$fields = ft_api_init_form_page();
$params = array(
  "submit_button" => "continue",
  "next_page" => "step4.php",
  "form_data" => $_POST
    );
ft_api_process_form($params);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
  <title>Form Tools Demo: Registration Form</title>

  <link rel="stylesheet" type="text/css" href="styles.css">
  <script type="text/javascript" src="rsv.js"></script>
  
</head>
<body>

	<h1>Demo Form: <span class="form_name">Registration</span></h1>

  <hr size="1" />
  <br />
	
	<div style="width:660px">

    <table cellpadding="0" cellspacing="0" width="660">
    <tr>
      <td><a href="step1.php"><img src="images/trail1.jpg" border="0" /></a></td>
      <td><a href="step2.php"><img src="images/trail2b.jpg" border="0" /></a></td>
      <td><img src="images/trail3b.jpg" /></td>
      <td><img src="images/trail4a.jpg" /></td>
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

<h3>REVIEW</h3>

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
  <td>
    Please review your information below and click the "REGISTER" button to proceed to the payment 
    page. If you need to change any values, click that section's <b>Edit</b> link to return to the 
    appropriate page, click the links above, or click your browser's back button to navigate there 
    manually.
  </td>
</tr>
</table>

<br />

<table class="table_1" cellpadding="2" cellspacing="1" width="100%">
<tr>
  <td colspan="2" class="table_1_bg">

    <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td class="table_1_title">CONTACT INFO</td>
      <td class="table_1_title" align="right"><a href="step1.php#contact_info" style="color:#ffffee">Edit</a></td>
    </tr>
    </table>

  </td>  
</tr>
<tr>
  <td width="250">Salutation</td>
  <td width="400" class="answer"><?=@$fields['attendee_salutation']?></td>
</tr>
<tr>
  <td>First Name</td>
  <td class="answer"><?=@$fields['attendee_first_name']?></td>
</tr>
<tr>
  <td>Nickname/Badge Name</td>
  <td class="answer"><?=@$fields['attendee_badge_name']?></td>
</tr>
<tr>
  <td>Last Name</td>
  <td class="answer"><?=@$fields['attendee_last_name']?></td>
</tr>
<tr>
  <td>Mailing Address</td>
  <td class="answer"><?=@$fields['office_address']?></td>
</tr>
<tr>
  <td>City</td>
  <td class="answer"><?=@$fields['office_city']?></td>
</tr>
<tr>
  <td>State / Province</td>
  <td class="answer"><?=@$fields['office_state']?></td>
</tr>
<tr>
  <td>Country</td>
  <td class="answer"><?=@$fields['office_country']?></td
</tr>
<tr>
  <td>Zip/Postal Code</td>
  <td class="answer"><?=@$fields['office_zip']?></td>
</tr>
<tr>
  <td>Email Address</td>
  <td class="answer"><?=@$fields['attendee_email']?></td>
</tr>
<tr>
  <td>Business Phone</td>
  <td class="answer"><?=@$fields['office_phone']?></td>
</tr>
<tr>
  <td>Mobile/Cell Phone</td>
  <td class="answer"><?=@$fields['mobile_phone']?></td>
</tr>
<tr>
  <td>Business Fax</td>
  <td class="answer"><?=@$fields['office_fax']?></td>
</tr>
</table>

<br />

<table class="table_1" cellpadding="2" cellspacing="1" width="100%">
<tr>
  <td colspan="2" class="table_1_bg">

    <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td class="table_1_title">PERSONAL INFO</td>
      <td class="table_1_title" align="right"><a href="step1.php#personal_info" style="color:#ffffee">Edit</a></td>
    </tr>
    </table>

  </td>  
</tr>
<tr>
  <td width="250">If you have any special meal considerations, please describe:</td>
  <td width="400" class="answer"><?=@$fields['meal_considerations']?></td>
</tr>
<tr>
  <td>Please advise us of any special physical constraints you may have:</td>
  <td class="answer"><?=@$fields['physical_constraints']?></td>
</tr>
<tr>
  <td>Emergency Contact Name</td>
  <td class="answer"><?=@$fields['emerg_contact_name']?></td>
</tr>
<tr>
  <td>Emergency Contact Phone Number</td>
  <td class="answer"><?=@$fields['emerg_contact_phone']?></td>
</tr>
<tr>
  <td>Emergency Contact Country</td>
  <td class="answer"><?=@$fields['emerg_contact_country']?></td>
</tr>
<tr>
  <td>Emergency Contact Relationship</td>
  <td class="answer"><?=@$fields['emerg_contact_relationship']?></td>
</tr>
</table>


<br />

<table class="table_1" cellpadding="2" cellspacing="1" width="100%">
<tr>
  <td colspan="2" class="table_1_bg">

    <table cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td class="table_1_title">TRAVEL INFO</td>
      <td class="table_1_title" align="right"><a href="step2.php" style="color:#ffffee">Edit</a></td>
    </tr>
    </table>

  </td>  
</tr>
<tr>
  <td width="240">
    Do you need transportation from the airport to the hotel on your arrival?
  </td>
  <td class="answer"><?=ucwords(@$fields['arrival_transportation'])?></td>
</tr>
<tr>
  <td>Arrival Date</td>
  <td class="answer">
  <?php 
  if (!empty($fields['arrival_date']))
    echo $fields['arrival_date'];
  else
    echo "To be advised later";
  ?>
  </td>
</tr>
<tr>
  <td>Arrival Via</td>
  <td class="answer">
  <?php 
  if (!empty($fields['arrival_via']))
    echo $fields['arrival_via'];
  else
    echo $fields['arrival_via_other'];
  ?>  
  </td>
</tr>
<tr>
  <td>Arrival Flight</td>
  <td class="answer">

  <?php
  if (!empty($fields['arrival_flight_airline']) && !empty($fields['arrival_flight_number']))
  {
    echo "Airline: " . $fields['arrival_flight_airline'] . "<br />";
    echo "Flight #: " . $fields['arrival_flight_number'] . "<br />";
  }
  else
  {
    if (!empty($fields['arrival_flight_na']))
      echo "Not Applicable<br />";
    if (!empty($fields['arrival_flight_advised_later']))
      echo "To be advised later<br />";
  }
  ?>
    
  </td>
</tr>
<tr>
  <td width="250">
    Last City Before Arrival (in case a flight is delayed and we need to track down the last city 
    of departure)
  </td>
  <td width="400" class="answer">
  <?php
  if (!empty($fields['last_city_before_arrival']))
    echo $fields['last_city_before_arrival'] . "<br />";
  else 
  {
    if (!empty($fields['last_city_na']))
      echo "Not Applicable<br />";
    if (!empty($fields['last_city_later']))
      echo "To be advised later<br />";  
  }
  ?>
  </td>
</tr>
<tr>
  <td width="240">
    Do you need transportation from the hotel to the cruise ship on your departure?
  </td>
  <td class="answer"><?=ucwords(@$fields['departure_transportation'])?></td>
</tr>
<tr>
  <td>Departure Date</td>
  <td class="answer">
  <?php 
  if (!empty($fields['departure_date']))
    echo $fields['departure_date'];
  else
    echo "To be advised later";
  ?>
  </td>
</tr>
<tr>
  <td>Special requests/comments:</td>
  <td class="answer"><?=@$fields['travel_special_requests']?></td>
</tr>
<tr>
  <td>Will a spouse or guest be travelling with you on your flight to Houston and require transportation?</td>
  <td class="answer"><?=ucwords(@$fields['bringing_guest'])?></td>
</tr>

</table>

<br />

<table class="error" style="width: 100%">
<tr>
  <td>
    This is page <b>3</b> of <b>5</b>. You must complete all steps in order for your registration
    to be processed. Please click continue.
  </td>
  <td align="right" width="140">

    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
      <input type="hidden" name="add" value="1" />
      <input type="submit" name="continue" value="Continue" style="font-weight: bold;"/>
      <input type="button" value="Print" onclick="window.print()" />
    </form>    
  </td>  
</tr>
</table>

</form>

</div>

</body>
</html>

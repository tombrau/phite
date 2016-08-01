<?php 

require_once("../../tools/formtools/global/api/api.php");

$errors = array();

// if submitted, process the form fields
if (isset($_POST) && !empty($_POST))
{
  if (empty($_POST['arrival_transportation']))
    $errors[] = "Please indicate whether you need transportation from the airport for the hotel on arrival.";
  if (empty($_POST['arrival_date']) && empty($_POST['arrival_date_advised_later']))
    $errors[] = "Please enter your arrival date or indicate that you will advise us later of this.";
  if (empty($_POST['arrival_via']))
    $errors[] = "Please indicate how you are arriving.";
  if ($_POST['arrival_via'] == "Other" && empty($_POST['arrival_via_other']))
    $errors[] = "Please indicate the other method by which you are arriving.";
  if ((empty($_POST['arrival_flight_airline']) || empty($_POST['arrival_flight_number'])) &&
      (empty($_POST['arrival_flight_na']) && empty($_POST['arrival_flight_advised_later'])))
    $errors[] = "Please enter your airline and flight number, or indicate that it is not applicable - or that you will advise us later.";
  if (empty($_POST['last_city_before_arrival']) && empty($_POST['last_city_na']) && empty($_POST['last_city_later']))
    $errors[] = "Please indicate the other method by which you are arriving.";
  if (empty($_POST['departure_transportation']))
    $errors[] = "Please indicate whether you need transportation from the hotel for the airport on departure.";
  if (empty($_POST['departure_date']) && empty($_POST['departure_date_advised_later']))
    $errors[] = "Please enter your departure date or indicate that you will advise us later of this.";
  if (empty($_POST['bringing_guest']))
    $errors[] = "Please indicate whether you are bringing a guest.";
}

if (empty($errors))
{
  $fields = ft_api_init_form_page();
  $params = array(
    "submit_button" => "continue",
    "next_page" => "step3.php",
    "form_data" => $_POST
      );
  ft_api_process_form($params);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
  <title>Form Tools Demo: Registration Form</title>

  <link rel="stylesheet" type="text/css" href="styles.css">
  <script type="text/javascript" src="rsv.js"></script>
  <link rel="stylesheet" type="text/css" media="all" href="../../formtools/global/jscalendar/skins/aqua/theme.css" title="Aqua" />
  <script type="text/javascript" src="../../formtools/global/jscalendar/calendar.js"></script>
  <script type="text/javascript" src="../../formtools/global/jscalendar/calendar-setup.js"></script>
  <script type="text/javascript" src="../../formtools/global/jscalendar/lang/calendar-en.js"></script>

  <script type="text/javascript">
  
  function validate(f)
  {
    if (!f.arrival_transportation[0].checked && !f.arrival_transportation[1].checked)
    {
      alert("Please indicate whether you need transportation from the airport for the hotel on arrival.");
      return false;
    } 
    if (!f.arrival_date.value && !f.arrival_date_advised_later.checked)
    {
      alert("Please enter your arrival date or indicate that you will advise us later of this.");
      return false;
    }
    if (!f.arrival_via.value)
    {
      alert("Please indicate how you are arriving.");
      return false;    
    } 
    if (f.arrival_via.value == "Other" && f.arrival_via_other.value == "")
    {
      alert("Please indicate the other method by which you are arriving.");
      return false;
    } 
    
    if ((f.arrival_flight_airline.value == "" || f.arrival_flight_number.value == "") && 
        (!f.arrival_flight_na.checked && !f.arrival_flight_advised_later.checked))  
    {
      alert("Please enter your airline and flight number, or indicate that it is not applicable - or that you will advise us later.");
      return false;
    } 
    
    if (f.last_city_before_arrival.value == "" && !f.last_city_na.checked && !f.last_city_later.checked)  
    {
      alert("Please enter your last city before arrival, or indicate that it is not applicable - or that you will advise us later.");
      return false;
    } 
  
    if (!f.departure_transportation[0].checked && !f.departure_transportation[1].checked)
    {
      alert("Please indicate whether you need transportation from the hotel for the airport on departure.");
      return false;
    }
    if (!f.departure_date.value && !f.departure_date_advised_later.checked)
    {
      alert("Please enter your departure date or indicate that you will advise us later of this.");
      return false;
    }
  
    if (!f.bringing_guest[0].checked && !f.bringing_guest[1].checked && !f.bringing_guest[2].checked)
    {
      alert("Please indicate whether you are bringing a guest.");
      return false;
    }
  
    return true;
  }
  
  function fill_fields()
  {
    document.regform.arrival_transportation[0].checked = true;
    document.regform.arrival_date.value = "06/12/2008";
    document.regform.arrival_via.value = "Plane";
    document.regform.arrival_flight_airline.value = "Westjet";
    document.regform.arrival_flight_number.value = "12345";
    document.regform.last_city_before_arrival.value = "Vancouver";
    document.regform.departure_transportation[0].checked = true;
    document.regform.departure_date.value = "06/15/2008";
    document.regform.travel_special_requests.value = "If at all possible, I'd like to be seated next to a screaming baby. Thanks!";
    document.regform.bringing_guest[2].checked = true;   
    return;
  }
  </script>

</head>
<body>

	<h1>Demo Form: <span class="form_name">Registration</span></h1>

  <p>
    <a href="javascript:fill_fields()">Click here</a> to automatically fill in the fields. Submit the form to continue.
  </p>

  <hr size="1" />
  <br />

	<div style="width:660px">
  
    <table cellpadding="0" cellspacing="0" width="660">
    <tr>
      <td><a href="index.php"><img src="images/trail1.jpg" border="0" /></a></td>
      <td><img src="images/trail2b.jpg" /></td>
      <td><img src="images/trail3a.jpg" /></td>
      <td><img src="images/trail4a.jpg" /></td>
      <td><img src="images/trail5a.jpg" /></td>
    </tr>
    </table>
  
    <?php
    
    if (!empty($errors))
    {
      echo "<div class='error'>Please correct the following errors, and resubmit the form:"
         . "<ul>";
      foreach ($errors as $error)
        echo "<li>$error</li>";
      echo "</ul></div><br />"; 
    }
    
    ?>
    
    <form name="regform" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return validate(this)" method="post">

    <h3>TRAVEL INFORMATION</h3>
    
    <p>
      This is page <b>2</b> of <b>5</b>. Please complete all 5 pages to successfully register.
    </p>
    
    <p>
      The cruise ship leaves from Tampa Bay, Florida every 2 weeks throughout the year on Sunday - 10am 
      sailing time. Please fill in the fields below and we will book your flight to Tampa Bay on the 
      date you specify. Hotel accommodations will be supplied.
    </p>
    
    <p>
      Note that fields marked with an <span class="red">*</span> are required.
    </p>
    
    <a name="attendee_travel_info"></a>
    <table class="table_1" cellpadding="2" cellspacing="1" width="660">
    <tr>
      <td colspan="3" class="table_1_bg">
    
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td class="table_1_title">YOUR TRAVEL INFO</td>
        </tr>
        </table>
    
      </td>  
    </tr>
    <tr>
      <td width="10" class="red">*</td>
      <td width="240">
        Do you need transportation from the airport to the hotel on your arrival?
      </td>
      <td class="answer">
        <input type="radio" name="arrival_transportation" id="arrival_transportation1" value="yes" <?php if (@$fields['arrival_transportation'] == "yes") echo "checked"; ?> /> <label for="arrival_transportation1">Yes</label>
        <input type="radio" name="arrival_transportation" id="arrival_transportation2" value="no" <?php if (@$fields['arrival_transportation'] == "no") echo "checked"; ?> /> <label for="arrival_transportation2">No</label> <br />   
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Arrival Date</td>
      <td class="answer">

        <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td><input type="text" name="arrival_date" id="arrival_date" size="12" value="<?=@$fields['arrival_date']?>"/></td>
          <td><img src="images/calendar_icon.gif" id="arrival_date_img" style="cursor:pointer" border="0" /></td>
        </tr>
        </table>

        <script type="text/javascript">
        Calendar.setup({
           inputField     :    "arrival_date",
           showsTime      :    true,
           timeFormat     :    "24",
           ifFormat       :    "%Y-%m-%d",
           button         :    "arrival_date_img",
           align          :    "Bl",
           singleClick    :    true
        });
        </script>
				
        <input type="checkbox" name="arrival_date_advised_later" id="arrival_date_advised_later1" value="yes"
          <?php if (@$fields['arrival_date_advised_later'] == "yes") echo "checked"; ?> /><label for="arrival_date_advised_later1">To be Advised Later</label>
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Arrival Via</td>
      <td class="answer">
    
        <select name="arrival_via">
          <option <?php if (@$fields['arrival_via'] == "") echo "selected"; ?> value="">Please Select</option>
          <option <?php if (@$fields['arrival_via'] == "Plane") echo "selected"; ?> value="Plane">Plane</option>
          <option <?php if (@$fields['arrival_via'] == "Train") echo "selected"; ?> value="Train">Train</option>
          <option <?php if (@$fields['arrival_via'] == "Own Vehicle") echo "selected"; ?> value="Own Vehicle">Own Vehicle</option>
          <option <?php if (@$fields['arrival_via'] == "Other") echo "selected"; ?> value="Other">Other</option>
        </select> If other, please specify: <input type="text" name="arrival_via_other" value="<?=@$fields['arrival_via_other']?>" maxlength="50" />
    
      </td>
    </tr>
    <tr>
      <td width="10" class="red">*</td>
      <td>Arrival Flight</td>
      <td class="answer">
    
        <table cellpadding="0" cellspacing="0">
        <tr>
          <td style="background-color: #eaeaea;" width="80">Airline:</td>
          <td><input type="text" name="arrival_flight_airline" size="30" maxlength="100" value="<?=@$fields['arrival_flight_airline']?>"/></td>
        </tr>
        <tr>
          <td style="background-color: #eaeaea;">Flight #:</td>
          <td><input type="text" name="arrival_flight_number" size="30" maxlength="100" value="<?=@$fields['arrival_flight_number']?>"/></td>
        </tr>
        </table>
        <input type="checkbox" name="arrival_flight_na" id="arrival_flight_na1" value="yes" 
          <?php if (@$fields['arrival_flight_na'] == "yes") echo "checked"; ?> /><label for="arrival_flight_na1">Not Applicable</label>   
          <br />
        <input type="checkbox" name="arrival_flight_advised_later" id="arrival_flight_advised_later1" value="yes" 
          <?php if (@$fields['arrival_flight_advised_later'] == "yes") echo "checked"; ?> /><label for="arrival_flight_advised_later1">To be Advised Later</label>
    
      </td>
    </tr>
    <tr>
      <td width="10" class="red">*</td>
      <td width="250">
        Last City Before Arrival (in case a flight is delayed and we need to track down the last city 
        of departure)
      </td>
      <td width="400" class="answer">
        <input type="text" name="last_city_before_arrival" size="30" maxlength="100" value="<?=@$fields['last_city_before_arrival']?>"/><br />
        <input type="checkbox" name="last_city_na" id="last_city_na1" value="yes"
          <?php if (@$fields['last_city_na'] == "yes") echo "checked"; ?> /><label for="last_city_na1">Not Applicable</label>   
          <br />     
        <input type="checkbox" name="last_city_later" id="last_city_later1" value="yes"
          <?php if (@$fields['last_city_later'] == "yes") echo "checked"; ?> /><label for="last_city_later1">To be Advised Later</label>
      </td>
    </tr>
    <tr>
      <td width="10" class="red">*</td>
      <td width="240">
        Do you need transportation from the hotel to the cruise ship on your departure?
      </td>
      <td class="answer">
        <input type="radio" name="departure_transportation" id="departure_transportation1" value="yes" <?php if (@$fields['departure_transportation'] == "yes") echo "checked"; ?> /> <label for="departure_transportation1">Yes</label>
        <input type="radio" name="departure_transportation" id="departure_transportation2" value="no" <?php if (@$fields['departure_transportation'] == "no") echo "checked"; ?> /> <label for="departure_transportation2">No</label>
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Departure Date</td>
      <td class="answer">

        <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td><input type="text" name="departure_date" id="departure_date" size="12" value="<?=@$fields['departure_date']?>"/></td>
          <td><img src="images/calendar_icon.gif" id="departure_date_img" style="cursor:pointer" border="0" /></td>
        </tr>
        </table>

        <script type="text/javascript">
        Calendar.setup({
           inputField     :    "departure_date",
           showsTime      :    true,
           timeFormat     :    "24",
           ifFormat       :    "%Y-%m-%d",
           button         :    "departure_date_img",
           align          :    "Bl",
           singleClick    :    true
        });
        </script>

        <input type="checkbox" name="departure_date_advised_later" id="departure_date_advised_later1" maxlength="50" value="yes" 
          <?php if (@$fields['departure_date_advised_later'] == "yes") echo "checked"; ?> /><label for="departure_date_advised_later1">To be Advised Later</label> 
      </td>
    </tr>
    <tr>
      <td class="red"> </td>
      <td>Special requests/comments:</td>
      <td class="answer"><textarea name="travel_special_requests" style="width: 100%; height: 80px;"><?=@$fields['travel_special_requests']?></textarea></td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Will a spouse or guest be travelling with you on your flight to Tampa Bay and require transportation?</td>
      <td class="answer">
        <input type="radio" name="bringing_guest" id="bringing_guest1" value="yes" <?php if (@$fields['bringing_guest'] == "yes") echo "checked"; ?> /><label for="bringing_guest1">Yes</label><br /> 
        <input type="radio" name="bringing_guest" id="bringing_guest2" value="no" <?php if (@$fields['bringing_guest'] == "no") echo "checked"; ?> /><label for="bringing_guest2">No</label><br /> 
        <input type="radio" name="bringing_guest" id="bringing_guest3" value="not_applicable" <?php if (@$fields['bringing_guest'] == "not_applicable") echo "checked"; ?> /><label for="bringing_guest3">Not Applicable</label>
      </td>
    </tr>
    </table>
    
    <br />
    
    <p>
      If you have not yet confirmed your travel information and have selected "To Be Advised Later" 
      for any of the above please remember to return to this registration form and enter this
      information once your details have been confirmed. Thank you!
    </p>
    
    <table class="error" style="width: 100%">
    <tr>
      <td>
        This is page <b>2</b> of <b>5</b>. You must complete all steps in order for your registration
        to be processed. Please click continue.
      </td>
      <td align="right" width="80">
        <input type="submit" name="continue" value="Continue"/>
      </td>  
    </tr>
    </table>
    
    </form>

  </div>    
   
</body>
</html>

<?php 

//require_once("../../tools/formtools/global/api/api.php");
require_once("../../tools/formtools/global/api/api.php");

// if submitted, validate the form. This uses the validation script included in the API
$errors = array();
if (isset($_POST) && !empty($_POST))
{
  $rules = array();
  $rules[] = "required,attendee_first_name,Please enter your first name.";
  $rules[] = "required,attendee_last_name,Please enter your last name.";
  $rules[] = "required,office_address,Please enter your mailing address.";
  $rules[] = "required,office_city,Please select your city.";
  $rules[] = "required,office_state,Please select your state.";
  $rules[] = "required,office_country,Please select your country.";
  $rules[] = "required,office_zip,Please enter your zip code.";
  $rules[] = "required,attendee_email,Please enter your email address.";
  $rules[] = "valid_email,attendee_email,Please enter a valid email address.";
  $rules[] = "required,office_phone,Please enter your business phone number.";
  $rules[] = "required,emerg_contact_name,Please enter the emergency contact name.";
  $rules[] = "required,emerg_contact_phone,Please enter the full emergency contact phone number.";
  $rules[] = "required,emerg_contact_country,Please enter your emergency contact's country.";
  $rules[] = "required,emerg_contact_relationship,Please enter your relationship to the emergency contact person.";
  $errors = validate_fields($_POST, $rules);
}

if (empty($errors))
{
  $fields = ft_api_init_form_page(1);
  //$fields = ft_api_init_form_page("", "test");
  //$fields = ft_api_init_form_page(1, "initialize");
  
  $params = array(
    "submit_button" => "continue",
    "next_page" => "step2.php",
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

  <script type="text/javascript">
  var rules = []

  // Attendee / work information
  rules.push("required,attendee_first_name,Please enter your first name.");
  rules.push("required,attendee_last_name,Please enter your last name.");
  rules.push("required,office_address,Please enter your mailing address.");
  rules.push("required,office_city,Please select your city.");
  rules.push("required,office_state,Please select your state.");
  rules.push("required,office_country,Please select your country.");
  rules.push("required,office_zip,Please enter your zip code.");
  rules.push("required,attendee_email,Please enter your email address.");
  rules.push("valid_email,attendee_email,Please enter a valid email address.");
  rules.push("required,office_phone,Please enter your business phone number.");
  
  // Additional info
  rules.push("required,emerg_contact_name,Please enter the emergency contact name.");
  rules.push("required,emerg_contact_phone,Please enter the full emergency contact phone number.");
  rules.push("required,emerg_contact_country,Please enter your emergency contact's country.");
  rules.push("required,emerg_contact_relationship,Please enter your relationship to the emergency contact person.");
  
  function fill_fields()
  {
    document.regform.attendee_salutation.value = "Mr.";
    document.regform.attendee_first_name.value = "Sam";
    document.regform.attendee_badge_name.value = "Sammy";
    document.regform.attendee_last_name.value = "Spade";
    document.regform.office_address.value = "100 Something St.";
    document.regform.office_city.value = "Vancouver";
    document.regform.office_state.value = "BC";
    document.regform.office_country.value = "Canada";
    document.regform.office_zip.value = "V6M4C1";
    document.regform.attendee_email.value = "samspade@somesite.ca";
    document.regform.office_phone.value = "(123) 456-7890";
    document.regform.mobile_phone.value = "(999) 999-9999";
    document.regform.office_fax.value = "(666) 777-8888";
    document.regform.meal_considerations.value = "I'm allergic to rodents. So no rat meat, please.";
    document.regform.physical_constraints.value = "I'm 9'4\"";
    document.regform.emerg_contact_name.value = "Condi Rice";
    document.regform.emerg_contact_phone.value = "(555) 123-5678";
    document.regform.emerg_contact_country.value = "United States";
    document.regform.emerg_contact_relationship.value = "Nemesis";
  
    return;
  }
  </script>

</head>
<body>

  <h1>
    Demo Form: <span class="form_name">Registration</span>
  </h1>

  <p>
    Here's a complex, multi-page form to let people register for a lovely cruise in the Persian 
    Gulf. It includes a simulated external payment gateway step for credit-card payments. As with 
    the petition demo form, it uses the <b>API</b> to submit the 
		submissions, which gives the developer more control. Also, some server-side (PHP) validation
		has been included.
	</p> 

  </p>
	  In this case, form submissions are not automatically finalized: after submitting the contents to 
		Form Tools to storage, they are not visible within the client interface. They only become visible after 
    a successful transaction is made through the (mock) external payment gateway - i.e. they only get 
    listed if the registrant makes a successful payment. This example is specifically for use
    with an external payment gateway, but the technique can be used in any situation when you 
    need to approve the submission at a later date, <i>after</i> the submission was initially made.
  </p>

  <p>
    As before, if you don't want the hassle of filling in all the fields, 
    <a href="javascript:fill_fields()">click here</a>. Submit the form to continue.
  </p>

  <hr size="1" />
  <br />

  <table cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/trail1.jpg" /></td>
    <td><img src="images/trail2a.jpg" /></td>
    <td><img src="images/trail3a.jpg" /></td>
    <td><img src="images/trail4a.jpg" /></td>
    <td><img src="images/trail5a.jpg" /></td>
  </tr>
  </table>

  <br />

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

  <form name="regform" action="<?=$_SERVER['PHP_SELF']?>" onsubmit="return rsv.validate(this, rules)" method="post">

    <h3>CONTACT INFORMATION</h3>
  
    <p>
      This is page <b>1</b> of <b>5</b>. Please complete all 5 pages to successfully register. Fields 
			marked with an <span class="red">*</span> are required. 
    </p>
    
    <a name="contact_info"></a>
    <table class="table_1" cellpadding="2" cellspacing="1" width="660">
    <tr>
      <td colspan="3" class="table_1_bg">
    
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td class="table_1_title">CONTACT INFO</td>
        </tr>
        </table>
    
      </td>
    </tr>
    <tr>
      <td class="red"> </td>
      <td>Salutation</td>
      <td class="answer">
        <select name="attendee_salutation">
          <option value="" <?php if (@$fields['attendee_salutation'] == "") echo "selected"; ?>>Please Select</option>
          <option value="Mr." <?php if (@$fields['attendee_salutation'] == "Mr.") echo "selected"; ?>>Mr.</option>
          <option value="Mrs." <?php if (@$fields['attendee_salutation'] == "Mrs.") echo "selected"; ?>>Mrs.</option>
          <option value="Ms." <?php if (@$fields['attendee_salutation'] == "Ms.") echo "selected"; ?>>Ms.</option>
          <option value="Miss" <?php if (@$fields['attendee_salutation'] == "Miss") echo "selected"; ?>>Miss</option>
          <option value="Dr." <?php if (@$fields['attendee_salutation'] == "Dr.") echo "selected"; ?>>Dr.</option>
        </select>    
      </td>
    </tr>
    <tr>
      <td width="10" class="red">*</td>
      <td width="250">First Name</td>
      <td width="400" class="answer"><input type="text" name="attendee_first_name" size="20" maxlength="50" value="<?=@$fields['attendee_first_name']?>" /></td>
    </tr>
    <tr>
      <td class="red"> </td>
      <td>Nickname/Badge Name</td>
      <td class="answer">
        <input type="text" name="attendee_badge_name" size="20" maxlength="50" value="<?=@$fields['attendee_badge_name']?>" />
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Last Name</td>
      <td class="answer"><input type="text" name="attendee_last_name" size="20" maxlength="50" value="<?=@$fields['attendee_last_name']?>" /></td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Mailing Address</td>
      <td class="answer">
        <input type="text" name="office_address" size="30" maxlength="100" value="<?=@$fields['office_address']?>" /><Br />
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>City</td>
      <td class="answer"><input type="text" name="office_city" size="20" maxlength="50" value="<?=@$fields['office_city']?>" /></td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>State / Province</td>
      <td class="answer">
        <input type="text" name="office_state" size="20" maxlength="50" value="<?=@$fields['office_state']?>" />
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Country</td>
      <td class="answer">
      <select name="office_country"> 
        <option <?php if (@$fields['office_country'] == "") echo "selected"; ?> value="">Select Country</option> 
        <option  <?php if (@$fields['office_country'] == "Canada") echo "selected"; ?> value="Canada">Canada</option> 
        <option  <?php if (@$fields['office_country'] == "United States") echo "selected"; ?> value="United States">United States</option> 
        <option  <?php if (@$fields['office_country'] == "United Kingdom") echo "selected"; ?> value="United Kingdom">United Kingdom</option> 
        <option  <?php if (@$fields['office_country'] == "Afghanistan") echo "selected"; ?> value="Afghanistan">Afghanistan</option> 
        <option  <?php if (@$fields['office_country'] == "Albania") echo "selected"; ?> value="Albania">Albania</option> 
        <option  <?php if (@$fields['office_country'] == "Algeria") echo "selected"; ?> value="Algeria">Algeria</option> 
        <option  <?php if (@$fields['office_country'] == "American Samoa") echo "selected"; ?> value="American Samoa">American Samoa</option> 
        <option  <?php if (@$fields['office_country'] == "Andorra") echo "selected"; ?> value="Andorra">Andorra</option> 
        <option  <?php if (@$fields['office_country'] == "Angola") echo "selected"; ?> value="Angola">Angola</option> 
        <option  <?php if (@$fields['office_country'] == "Anguilla") echo "selected"; ?> value="Anguilla">Anguilla</option> 
        <option  <?php if (@$fields['office_country'] == "Antarctica") echo "selected"; ?> value="Antarctica">Antarctica</option> 
        <option  <?php if (@$fields['office_country'] == "Antigua and Barbuda") echo "selected"; ?> value="Antigua and Barbuda">Antigua and Barbuda</option> 
        <option  <?php if (@$fields['office_country'] == "Argentina") echo "selected"; ?> value="Argentina">Argentina</option> 
        <option  <?php if (@$fields['office_country'] == "Armenia") echo "selected"; ?> value="Armenia">Armenia</option> 
        <option  <?php if (@$fields['office_country'] == "Aruba") echo "selected"; ?> value="Aruba">Aruba</option> 
        <option  <?php if (@$fields['office_country'] == "Australia") echo "selected"; ?> value="Australia">Australia</option> 
        <option  <?php if (@$fields['office_country'] == "Austria") echo "selected"; ?> value="Austria">Austria</option> 
        <option  <?php if (@$fields['office_country'] == "Azerbaijan") echo "selected"; ?> value="Azerbaijan">Azerbaijan</option> 
        <option  <?php if (@$fields['office_country'] == "Bahamas") echo "selected"; ?> value="Bahamas">Bahamas</option> 
        <option  <?php if (@$fields['office_country'] == "Bahrain") echo "selected"; ?> value="Bahrain">Bahrain</option> 
        <option  <?php if (@$fields['office_country'] == "Bangladesh") echo "selected"; ?> value="Bangladesh">Bangladesh</option> 
        <option  <?php if (@$fields['office_country'] == "Barbados") echo "selected"; ?> value="Barbados">Barbados</option> 
        <option  <?php if (@$fields['office_country'] == "Belarus") echo "selected"; ?> value="Belarus">Belarus</option> 
        <option  <?php if (@$fields['office_country'] == "Belgium") echo "selected"; ?> value="Belgium">Belgium</option> 
        <option  <?php if (@$fields['office_country'] == "Belize") echo "selected"; ?> value="Belize">Belize</option> 
        <option  <?php if (@$fields['office_country'] == "Benin") echo "selected"; ?> value="Benin">Benin</option> 
        <option  <?php if (@$fields['office_country'] == "Bermuda") echo "selected"; ?> value="Bermuda">Bermuda</option> 
        <option  <?php if (@$fields['office_country'] == "Bhutan") echo "selected"; ?> value="Bhutan">Bhutan</option> 
        <option  <?php if (@$fields['office_country'] == "Bolivia") echo "selected"; ?> value="Bolivia">Bolivia</option> 
        <option  <?php if (@$fields['office_country'] == "Bosnia and Herzegovina") echo "selected"; ?> value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
        <option  <?php if (@$fields['office_country'] == "Botswana") echo "selected"; ?> value="Botswana">Botswana</option> 
        <option  <?php if (@$fields['office_country'] == "Bouvet Island") echo "selected"; ?> value="Bouvet Island">Bouvet Island</option> 
        <option  <?php if (@$fields['office_country'] == "Brazil") echo "selected"; ?> value="Brazil">Brazil</option> 
        <option  <?php if (@$fields['office_country'] == "British Indian Ocean Territory") echo "selected"; ?> value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
        <option  <?php if (@$fields['office_country'] == "Brunei Darussalam") echo "selected"; ?> value="Brunei Darussalam">Brunei Darussalam</option> 
        <option  <?php if (@$fields['office_country'] == "Bulgaria") echo "selected"; ?> value="Bulgaria">Bulgaria</option> 
        <option  <?php if (@$fields['office_country'] == "Burkina Faso") echo "selected"; ?> value="Burkina Faso">Burkina Faso</option> 
        <option  <?php if (@$fields['office_country'] == "Burundi") echo "selected"; ?> value="Burundi">Burundi</option> 
        <option  <?php if (@$fields['office_country'] == "Cambodia") echo "selected"; ?> value="Cambodia">Cambodia</option> 
        <option  <?php if (@$fields['office_country'] == "Cameroon") echo "selected"; ?> value="Cameroon">Cameroon</option> 
        <option  <?php if (@$fields['office_country'] == "Cape Verde") echo "selected"; ?> value="Cape Verde">Cape Verde</option> 
        <option  <?php if (@$fields['office_country'] == "Cayman Islands") echo "selected"; ?> value="Cayman Islands">Cayman Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Central African Republic") echo "selected"; ?> value="Central African Republic">Central African Republic</option> 
        <option  <?php if (@$fields['office_country'] == "Chad") echo "selected"; ?> value="Chad">Chad</option> 
        <option  <?php if (@$fields['office_country'] == "Chile") echo "selected"; ?> value="Chile">Chile</option> 
        <option  <?php if (@$fields['office_country'] == "China") echo "selected"; ?> value="China">China</option> 
        <option  <?php if (@$fields['office_country'] == "Christmas Island") echo "selected"; ?> value="Christmas Island">Christmas Island</option> 
        <option  <?php if (@$fields['office_country'] == "Cocos (Keeling) Islands") echo "selected"; ?> value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Colombia") echo "selected"; ?> value="Colombia">Colombia</option> 
        <option  <?php if (@$fields['office_country'] == "Comoros") echo "selected"; ?> value="Comoros">Comoros</option> 
        <option  <?php if (@$fields['office_country'] == "Congo") echo "selected"; ?> value="Congo">Congo</option> 
        <option  <?php if (@$fields['office_country'] == "Congo, The Democratic Republic of The") echo "selected"; ?> value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
        <option  <?php if (@$fields['office_country'] == "Cook Islands") echo "selected"; ?> value="Cook Islands">Cook Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Costa Rica") echo "selected"; ?> value="Costa Rica">Costa Rica</option> 
        <option  <?php if (@$fields['office_country'] == "Cote D'ivoire") echo "selected"; ?> value="Cote D'ivoire">Cote D'ivoire</option> 
        <option  <?php if (@$fields['office_country'] == "Croatia") echo "selected"; ?> value="Croatia">Croatia</option> 
        <option  <?php if (@$fields['office_country'] == "Cuba") echo "selected"; ?> value="Cuba">Cuba</option> 
        <option  <?php if (@$fields['office_country'] == "Cyprus") echo "selected"; ?> value="Cyprus">Cyprus</option> 
        <option  <?php if (@$fields['office_country'] == "Czech Republic") echo "selected"; ?> value="Czech Republic">Czech Republic</option> 
        <option  <?php if (@$fields['office_country'] == "Denmark") echo "selected"; ?> value="Denmark">Denmark</option> 
        <option  <?php if (@$fields['office_country'] == "Djibouti") echo "selected"; ?> value="Djibouti">Djibouti</option> 
        <option  <?php if (@$fields['office_country'] == "Dominica") echo "selected"; ?> value="Dominica">Dominica</option> 
        <option  <?php if (@$fields['office_country'] == "Dominican Republic") echo "selected"; ?> value="Dominican Republic">Dominican Republic</option> 
        <option  <?php if (@$fields['office_country'] == "Ecuador") echo "selected"; ?> value="Ecuador">Ecuador</option> 
        <option  <?php if (@$fields['office_country'] == "Egypt") echo "selected"; ?> value="Egypt">Egypt</option> 
        <option  <?php if (@$fields['office_country'] == "El Salvador") echo "selected"; ?> value="El Salvador">El Salvador</option> 
        <option  <?php if (@$fields['office_country'] == "Equatorial Guinea") echo "selected"; ?> value="Equatorial Guinea">Equatorial Guinea</option> 
        <option  <?php if (@$fields['office_country'] == "Eritrea") echo "selected"; ?> value="Eritrea">Eritrea</option> 
        <option  <?php if (@$fields['office_country'] == "Estonia") echo "selected"; ?> value="Estonia">Estonia</option> 
        <option  <?php if (@$fields['office_country'] == "Ethiopia") echo "selected"; ?> value="Ethiopia">Ethiopia</option> 
        <option  <?php if (@$fields['office_country'] == "Falkland Islands (Malvinas)") echo "selected"; ?> value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
        <option  <?php if (@$fields['office_country'] == "Faroe Islands") echo "selected"; ?> value="Faroe Islands">Faroe Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Fiji") echo "selected"; ?> value="Fiji">Fiji</option> 
        <option  <?php if (@$fields['office_country'] == "Finland") echo "selected"; ?> value="Finland">Finland</option> 
        <option  <?php if (@$fields['office_country'] == "France") echo "selected"; ?> value="France">France</option> 
        <option  <?php if (@$fields['office_country'] == "French Guiana") echo "selected"; ?> value="French Guiana">French Guiana</option> 
        <option  <?php if (@$fields['office_country'] == "French Polynesia") echo "selected"; ?> value="French Polynesia">French Polynesia</option> 
        <option  <?php if (@$fields['office_country'] == "French Southern Territories") echo "selected"; ?> value="French Southern Territories">French Southern Territories</option> 
        <option  <?php if (@$fields['office_country'] == "Gabon") echo "selected"; ?> value="Gabon">Gabon</option> 
        <option  <?php if (@$fields['office_country'] == "Gambia") echo "selected"; ?> value="Gambia">Gambia</option> 
        <option  <?php if (@$fields['office_country'] == "Georgia") echo "selected"; ?> value="Georgia">Georgia</option> 
        <option  <?php if (@$fields['office_country'] == "Germany") echo "selected"; ?> value="Germany">Germany</option> 
        <option  <?php if (@$fields['office_country'] == "Ghana") echo "selected"; ?> value="Ghana">Ghana</option> 
        <option  <?php if (@$fields['office_country'] == "Gibraltar") echo "selected"; ?> value="Gibraltar">Gibraltar</option> 
        <option  <?php if (@$fields['office_country'] == "Greece") echo "selected"; ?> value="Greece">Greece</option> 
        <option  <?php if (@$fields['office_country'] == "Greenland") echo "selected"; ?> value="Greenland">Greenland</option> 
        <option  <?php if (@$fields['office_country'] == "Grenada") echo "selected"; ?> value="Grenada">Grenada</option> 
        <option  <?php if (@$fields['office_country'] == "Guadeloupe") echo "selected"; ?> value="Guadeloupe">Guadeloupe</option> 
        <option  <?php if (@$fields['office_country'] == "Guam") echo "selected"; ?> value="Guam">Guam</option> 
        <option  <?php if (@$fields['office_country'] == "Guatemala") echo "selected"; ?> value="Guatemala">Guatemala</option> 
        <option  <?php if (@$fields['office_country'] == "Guinea") echo "selected"; ?> value="Guinea">Guinea</option> 
        <option  <?php if (@$fields['office_country'] == "Guinea-bissau") echo "selected"; ?> value="Guinea-bissau">Guinea-bissau</option> 
        <option  <?php if (@$fields['office_country'] == "Guyana") echo "selected"; ?> value="Guyana">Guyana</option> 
        <option  <?php if (@$fields['office_country'] == "Haiti") echo "selected"; ?> value="Haiti">Haiti</option> 
        <option  <?php if (@$fields['office_country'] == "Heard Island and Mcdonald Islands") echo "selected"; ?> value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Holy See (Vatican City State)") echo "selected"; ?> value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
        <option  <?php if (@$fields['office_country'] == "Honduras") echo "selected"; ?> value="Honduras">Honduras</option> 
        <option  <?php if (@$fields['office_country'] == "Hong Kong") echo "selected"; ?> value="Hong Kong">Hong Kong</option> 
        <option  <?php if (@$fields['office_country'] == "Hungary") echo "selected"; ?> value="Hungary">Hungary</option> 
        <option  <?php if (@$fields['office_country'] == "Iceland") echo "selected"; ?> value="Iceland">Iceland</option> 
        <option  <?php if (@$fields['office_country'] == "India") echo "selected"; ?> value="India">India</option> 
        <option  <?php if (@$fields['office_country'] == "Indonesia") echo "selected"; ?> value="Indonesia">Indonesia</option> 
        <option  <?php if (@$fields['office_country'] == "Iran, Islamic Republic of") echo "selected"; ?> value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
        <option  <?php if (@$fields['office_country'] == "Iraq") echo "selected"; ?> value="Iraq">Iraq</option> 
        <option  <?php if (@$fields['office_country'] == "Ireland") echo "selected"; ?> value="Ireland">Ireland</option> 
        <option  <?php if (@$fields['office_country'] == "Israel") echo "selected"; ?> value="Israel">Israel</option> 
        <option  <?php if (@$fields['office_country'] == "Italy") echo "selected"; ?> value="Italy">Italy</option> 
        <option  <?php if (@$fields['office_country'] == "Jamaica") echo "selected"; ?> value="Jamaica">Jamaica</option> 
        <option  <?php if (@$fields['office_country'] == "Japan") echo "selected"; ?> value="Japan">Japan</option> 
        <option  <?php if (@$fields['office_country'] == "Jordan") echo "selected"; ?> value="Jordan">Jordan</option> 
        <option  <?php if (@$fields['office_country'] == "Kazakhstan") echo "selected"; ?> value="Kazakhstan">Kazakhstan</option> 
        <option  <?php if (@$fields['office_country'] == "Kenya") echo "selected"; ?> value="Kenya">Kenya</option> 
        <option  <?php if (@$fields['office_country'] == "Kiribati") echo "selected"; ?> value="Kiribati">Kiribati</option> 
        <option  <?php if (@$fields['office_country'] == "Korea") echo "selected"; ?> value="Korea">Korea</option> 
        <option  <?php if (@$fields['office_country'] == "Korea, Republic of") echo "selected"; ?> value="Korea, Republic of">Korea, Republic of</option> 
        <option  <?php if (@$fields['office_country'] == "Kuwait") echo "selected"; ?> value="Kuwait">Kuwait</option> 
        <option  <?php if (@$fields['office_country'] == "Kyrgyzstan") echo "selected"; ?> value="Kyrgyzstan">Kyrgyzstan</option> 
        <option  <?php if (@$fields['office_country'] == "Lao People's Democratic Republic") echo "selected"; ?> value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
        <option  <?php if (@$fields['office_country'] == "Latvia") echo "selected"; ?> value="Latvia">Latvia</option> 
        <option  <?php if (@$fields['office_country'] == "Lebanon") echo "selected"; ?> value="Lebanon">Lebanon</option> 
        <option  <?php if (@$fields['office_country'] == "Lesotho") echo "selected"; ?> value="Lesotho">Lesotho</option> 
        <option  <?php if (@$fields['office_country'] == "Liberia") echo "selected"; ?> value="Liberia">Liberia</option> 
        <option  <?php if (@$fields['office_country'] == "Libyan Arab Jamahiriya") echo "selected"; ?> value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
        <option  <?php if (@$fields['office_country'] == "Liechtenstein") echo "selected"; ?> value="Liechtenstein">Liechtenstein</option> 
        <option  <?php if (@$fields['office_country'] == "Lithuania") echo "selected"; ?> value="Lithuania">Lithuania</option> 
        <option  <?php if (@$fields['office_country'] == "Luxembourg") echo "selected"; ?> value="Luxembourg">Luxembourg</option> 
        <option  <?php if (@$fields['office_country'] == "Macao") echo "selected"; ?> value="Macao">Macao</option> 
        <option  <?php if (@$fields['office_country'] == "Macedonia") echo "selected"; ?> value="Macedonia">Macedonia</option> 
        <option  <?php if (@$fields['office_country'] == "Madagascar") echo "selected"; ?> value="Madagascar">Madagascar</option> 
        <option  <?php if (@$fields['office_country'] == "Malawi") echo "selected"; ?> value="Malawi">Malawi</option> 
        <option  <?php if (@$fields['office_country'] == "Malaysia") echo "selected"; ?> value="Malaysia">Malaysia</option> 
        <option  <?php if (@$fields['office_country'] == "Maldives") echo "selected"; ?> value="Maldives">Maldives</option> 
        <option  <?php if (@$fields['office_country'] == "Mali") echo "selected"; ?> value="Mali">Mali</option> 
        <option  <?php if (@$fields['office_country'] == "Malta") echo "selected"; ?> value="Malta">Malta</option> 
        <option  <?php if (@$fields['office_country'] == "Marshall Islands") echo "selected"; ?> value="Marshall Islands">Marshall Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Martinique") echo "selected"; ?> value="Martinique">Martinique</option> 
        <option  <?php if (@$fields['office_country'] == "Mauritania") echo "selected"; ?> value="Mauritania">Mauritania</option> 
        <option  <?php if (@$fields['office_country'] == "Mauritius") echo "selected"; ?> value="Mauritius">Mauritius</option> 
        <option  <?php if (@$fields['office_country'] == "Mayotte") echo "selected"; ?> value="Mayotte">Mayotte</option> 
        <option  <?php if (@$fields['office_country'] == "Mexico") echo "selected"; ?> value="Mexico">Mexico</option> 
        <option  <?php if (@$fields['office_country'] == "Micronesia") echo "selected"; ?> value="Micronesia">Micronesia</option> 
        <option  <?php if (@$fields['office_country'] == "Moldova") echo "selected"; ?> value="Moldova">Moldova</option> 
        <option  <?php if (@$fields['office_country'] == "Monaco") echo "selected"; ?> value="Monaco">Monaco</option> 
        <option  <?php if (@$fields['office_country'] == "Mongolia") echo "selected"; ?> value="Mongolia">Mongolia</option> 
        <option  <?php if (@$fields['office_country'] == "Montserrat") echo "selected"; ?> value="Montserrat">Montserrat</option> 
        <option  <?php if (@$fields['office_country'] == "Morocco") echo "selected"; ?> value="Morocco">Morocco</option> 
        <option  <?php if (@$fields['office_country'] == "Mozambique") echo "selected"; ?> value="Mozambique">Mozambique</option> 
        <option  <?php if (@$fields['office_country'] == "Myanmar") echo "selected"; ?> value="Myanmar">Myanmar</option> 
        <option  <?php if (@$fields['office_country'] == "Namibia") echo "selected"; ?> value="Namibia">Namibia</option> 
        <option  <?php if (@$fields['office_country'] == "Naurux") echo "selected"; ?> value="Nauru">Nauru</option> 
        <option  <?php if (@$fields['office_country'] == "Nepal") echo "selected"; ?> value="Nepal">Nepal</option> 
        <option  <?php if (@$fields['office_country'] == "Netherlands") echo "selected"; ?> value="Netherlands">Netherlands</option> 
        <option  <?php if (@$fields['office_country'] == "Netherlands Antilles") echo "selected"; ?> value="Netherlands Antilles">Netherlands Antilles</option> 
        <option  <?php if (@$fields['office_country'] == "New Caledonia") echo "selected"; ?> value="New Caledonia">New Caledonia</option> 
        <option  <?php if (@$fields['office_country'] == "New Zealand") echo "selected"; ?> value="New Zealand">New Zealand</option> 
        <option  <?php if (@$fields['office_country'] == "Nicaragua") echo "selected"; ?> value="Nicaragua">Nicaragua</option> 
        <option  <?php if (@$fields['office_country'] == "Niger") echo "selected"; ?> value="Niger">Niger</option> 
        <option  <?php if (@$fields['office_country'] == "Nigeria") echo "selected"; ?> value="Nigeria">Nigeria</option> 
        <option  <?php if (@$fields['office_country'] == "Niue") echo "selected"; ?> value="Niue">Niue</option> 
        <option  <?php if (@$fields['office_country'] == "Norfolk Island") echo "selected"; ?> value="Norfolk Island">Norfolk Island</option> 
        <option  <?php if (@$fields['office_country'] == "Northern Mariana Islands") echo "selected"; ?> value="Northern Mariana Islands">Northern Mariana Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Norway") echo "selected"; ?> value="Norway">Norway</option> 
        <option  <?php if (@$fields['office_country'] == "Oman") echo "selected"; ?> value="Oman">Oman</option> 
        <option  <?php if (@$fields['office_country'] == "Pakistan") echo "selected"; ?> value="Pakistan">Pakistan</option> 
        <option  <?php if (@$fields['office_country'] == "Palau") echo "selected"; ?> value="Palau">Palau</option> 
        <option  <?php if (@$fields['office_country'] == "Palestinian Territory, Occupied") echo "selected"; ?> value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
        <option  <?php if (@$fields['office_country'] == "Panama") echo "selected"; ?> value="Panama">Panama</option> 
        <option  <?php if (@$fields['office_country'] == "Papua New Guinea") echo "selected"; ?> value="Papua New Guinea">Papua New Guinea</option> 
        <option  <?php if (@$fields['office_country'] == "Paraguay") echo "selected"; ?> value="Paraguay">Paraguay</option> 
        <option  <?php if (@$fields['office_country'] == "Peru") echo "selected"; ?> value="Peru">Peru</option> 
        <option  <?php if (@$fields['office_country'] == "Philippines") echo "selected"; ?> value="Philippines">Philippines</option> 
        <option  <?php if (@$fields['office_country'] == "Pitcairn") echo "selected"; ?> value="Pitcairn">Pitcairn</option> 
        <option  <?php if (@$fields['office_country'] == "Poland") echo "selected"; ?> value="Poland">Poland</option> 
        <option  <?php if (@$fields['office_country'] == "Portugal") echo "selected"; ?> value="Portugal">Portugal</option> 
        <option  <?php if (@$fields['office_country'] == "Puerto Rico") echo "selected"; ?> value="Puerto Rico">Puerto Rico</option> 
        <option  <?php if (@$fields['office_country'] == "Qatar") echo "selected"; ?> value="Qatar">Qatar</option> 
        <option  <?php if (@$fields['office_country'] == "Reunion") echo "selected"; ?> value="Reunion">Reunion</option> 
        <option  <?php if (@$fields['office_country'] == "Romania") echo "selected"; ?> value="Romania">Romania</option> 
        <option  <?php if (@$fields['office_country'] == "Russian Federation") echo "selected"; ?> value="Russian Federation">Russian Federation</option> 
        <option  <?php if (@$fields['office_country'] == "Rwanda") echo "selected"; ?> value="Rwanda">Rwanda</option> 
        <option  <?php if (@$fields['office_country'] == "Saint Helena") echo "selected"; ?> value="Saint Helena">Saint Helena</option> 
        <option  <?php if (@$fields['office_country'] == "Saint Kitts and Nevis") echo "selected"; ?> value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
        <option  <?php if (@$fields['office_country'] == "Saint Lucia") echo "selected"; ?> value="Saint Lucia">Saint Lucia</option> 
        <option  <?php if (@$fields['office_country'] == "Saint Pierre and Miquelon") echo "selected"; ?> value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
        <option  <?php if (@$fields['office_country'] == "Saint Vincent and The Grenadines") echo "selected"; ?> value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
        <option  <?php if (@$fields['office_country'] == "Samoa") echo "selected"; ?> value="Samoa">Samoa</option> 
        <option  <?php if (@$fields['office_country'] == "San Marino") echo "selected"; ?> value="San Marino">San Marino</option> 
        <option  <?php if (@$fields['office_country'] == "Sao Tome and Principe") echo "selected"; ?> value="Sao Tome and Principe">Sao Tome and Principe</option> 
        <option  <?php if (@$fields['office_country'] == "Saudi Arabia") echo "selected"; ?> value="Saudi Arabia">Saudi Arabia</option> 
        <option  <?php if (@$fields['office_country'] == "Senegal") echo "selected"; ?> value="Senegal">Senegal</option> 
        <option  <?php if (@$fields['office_country'] == "Serbia and Montenegro") echo "selected"; ?> value="Serbia and Montenegro">Serbia and Montenegro</option> 
        <option  <?php if (@$fields['office_country'] == "Seychelles") echo "selected"; ?> value="Seychelles">Seychelles</option> 
        <option  <?php if (@$fields['office_country'] == "Sierra Leone") echo "selected"; ?> value="Sierra Leone">Sierra Leone</option> 
        <option  <?php if (@$fields['office_country'] == "Singapore") echo "selected"; ?> value="Singapore">Singapore</option> 
        <option  <?php if (@$fields['office_country'] == "Slovakia") echo "selected"; ?> value="Slovakia">Slovakia</option> 
        <option  <?php if (@$fields['office_country'] == "Slovenia") echo "selected"; ?> value="Slovenia">Slovenia</option> 
        <option  <?php if (@$fields['office_country'] == "Solomon Islands") echo "selected"; ?> value="Solomon Islands">Solomon Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Somalia") echo "selected"; ?> value="Somalia">Somalia</option> 
        <option  <?php if (@$fields['office_country'] == "South Africa") echo "selected"; ?> value="South Africa">South Africa</option> 
        <option  <?php if (@$fields['office_country'] == "South Georgia and The South Sandwich Islands") echo "selected"; ?> value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Spain") echo "selected"; ?> value="Spain">Spain</option> 
        <option  <?php if (@$fields['office_country'] == "Sri Lanka") echo "selected"; ?> value="Sri Lanka">Sri Lanka</option> 
        <option  <?php if (@$fields['office_country'] == "Sudan") echo "selected"; ?> value="Sudan">Sudan</option> 
        <option  <?php if (@$fields['office_country'] == "Suriname") echo "selected"; ?> value="Suriname">Suriname</option> 
        <option  <?php if (@$fields['office_country'] == "Svalbard and Jan Mayen") echo "selected"; ?> value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
        <option  <?php if (@$fields['office_country'] == "Swaziland") echo "selected"; ?> value="Swaziland">Swaziland</option> 
        <option  <?php if (@$fields['office_country'] == "Sweden") echo "selected"; ?> value="Sweden">Sweden</option> 
        <option  <?php if (@$fields['office_country'] == "Switzerland") echo "selected"; ?> value="Switzerland">Switzerland</option> 
        <option  <?php if (@$fields['office_country'] == "Syrian Arab Republic") echo "selected"; ?> value="Syrian Arab Republic">Syrian Arab Republic</option> 
        <option  <?php if (@$fields['office_country'] == "Taiwan, Province of China") echo "selected"; ?> value="Taiwan, Province of China">Taiwan, Province of China</option> 
        <option  <?php if (@$fields['office_country'] == "Tajikistan") echo "selected"; ?> value="Tajikistan">Tajikistan</option> 
        <option  <?php if (@$fields['office_country'] == "Tanzania, United Republic of") echo "selected"; ?> value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
        <option  <?php if (@$fields['office_country'] == "Thailand") echo "selected"; ?> value="Thailand">Thailand</option> 
        <option  <?php if (@$fields['office_country'] == "Timor-leste") echo "selected"; ?> value="Timor-leste">Timor-leste</option> 
        <option  <?php if (@$fields['office_country'] == "Togo") echo "selected"; ?> value="Togo">Togo</option> 
        <option  <?php if (@$fields['office_country'] == "Tokelau") echo "selected"; ?> value="Tokelau">Tokelau</option> 
        <option  <?php if (@$fields['office_country'] == "Tonga") echo "selected"; ?> value="Tonga">Tonga</option> 
        <option  <?php if (@$fields['office_country'] == "Trinidad and Tobago") echo "selected"; ?> value="Trinidad and Tobago">Trinidad and Tobago</option> 
        <option  <?php if (@$fields['office_country'] == "Tunisia") echo "selected"; ?> value="Tunisia">Tunisia</option> 
        <option  <?php if (@$fields['office_country'] == "Turkey") echo "selected"; ?> value="Turkey">Turkey</option> 
        <option  <?php if (@$fields['office_country'] == "Turkmenistan") echo "selected"; ?> value="Turkmenistan">Turkmenistan</option> 
        <option  <?php if (@$fields['office_country'] == "Turks and Caicos Islands") echo "selected"; ?> value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Tuvalu") echo "selected"; ?> value="Tuvalu">Tuvalu</option> 
        <option  <?php if (@$fields['office_country'] == "Uganda") echo "selected"; ?> value="Uganda">Uganda</option> 
        <option  <?php if (@$fields['office_country'] == "Ukraine") echo "selected"; ?> value="Ukraine">Ukraine</option> 
        <option  <?php if (@$fields['office_country'] == "United Arab Emirates") echo "selected"; ?> value="United Arab Emirates">United Arab Emirates</option> 
        <option  <?php if (@$fields['office_country'] == "United Kingdom") echo "selected"; ?> value="United Kingdom">United Kingdom</option> 
        <option  <?php if (@$fields['office_country'] == "United States") echo "selected"; ?> value="United States">United States</option> 
        <option  <?php if (@$fields['office_country'] == "United States Minor Outlying Islands") echo "selected"; ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
        <option  <?php if (@$fields['office_country'] == "Uruguay") echo "selected"; ?> value="Uruguay">Uruguay</option> 
        <option  <?php if (@$fields['office_country'] == "Uzbekistan") echo "selected"; ?> value="Uzbekistan">Uzbekistan</option> 
        <option  <?php if (@$fields['office_country'] == "Vanuatu") echo "selected"; ?> value="Vanuatu">Vanuatu</option> 
        <option  <?php if (@$fields['office_country'] == "Venezuela") echo "selected"; ?> value="Venezuela">Venezuela</option> 
        <option  <?php if (@$fields['office_country'] == "Viet Nam") echo "selected"; ?> value="Viet Nam">Viet Nam</option> 
        <option  <?php if (@$fields['office_country'] == "Virgin Islands, British") echo "selected"; ?> value="Virgin Islands, British">Virgin Islands, British</option> 
        <option  <?php if (@$fields['office_country'] == "Virgin Islands, U.S.") echo "selected"; ?> value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
        <option  <?php if (@$fields['office_country'] == "Wallis and Futuna") echo "selected"; ?> value="Wallis and Futuna">Wallis and Futuna</option> 
        <option  <?php if (@$fields['office_country'] == "Western Sahara") echo "selected"; ?> value="Western Sahara">Western Sahara</option> 
        <option  <?php if (@$fields['office_country'] == "Yemen") echo "selected"; ?> value="Yemen">Yemen</option> 
        <option  <?php if (@$fields['office_country'] == "Zambia") echo "selected"; ?> value="Zambia">Zambia</option> 
        <option  <?php if (@$fields['office_country'] == "Zimbabwe") echo "selected"; ?> value="Zimbabwe">Zimbabwe</option>
      </select>
      
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Zip/Postal Code</td>
      <td class="answer"><input type="text" name="office_zip" size="10" maxlength="10" value="<?=@$fields['office_zip']?>"/></td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Email Address</td>
      <td class="answer">
         <input type="text" name="attendee_email" size="30" maxlength="100" value="<?=@$fields['attendee_email']?>"/><br />
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Business Phone</td>
      <td class="answer">
         <input type="text" name="office_phone" size="14" maxlength="15" value="<?=@$fields['office_phone']?>"/> Please include your area code
      </td>
    </tr>
    <tr>
      <td class="red"> </td>
      <td>Mobile / Cell Phone</td>
      <td class="answer">
         <input type="text" name="mobile_phone" size="14" maxlength="15" value="<?=@$fields['mobile_phone']?>"/> Please include your area code
      </td>
    </tr>
    <tr>
      <td class="red"></td>
      <td>Business Fax</td>
      <td class="answer">
         <input type="text" name="office_fax" size="14" maxlength="15" value="<?=@$fields['office_fax']?>"/> Please include your area code
      </td>
    </tr>
    </table>
    
    <br />
    
    <a name="personal_info"></a>
    <table class="table_1" cellpadding="2" cellspacing="1" width="660">
    <tr>
      <td colspan="3" class="table_1_bg">
    
        <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td class="table_1_title">PERSONAL INFO</td>
        </tr>
        </table>
    
      </td>  
    </tr>
    <tr>
      <td width="10" class="red"></td>
      <td width="250">If you have any special meal considerations, please describe:</td>
      <td width="400" class="answer"><textarea name="meal_considerations" style="width: 250px; height: 80px;"><?=@$fields['meal_considerations']?></textarea></td>
    </tr>
    <tr>
      <td class="red"></td>
      <td>Please advise us of any special physical constraints you may have:</td>
      <td class="answer"><textarea name="physical_constraints" style="width: 250px; height: 80px;"><?=@$fields['physical_constraints']?></textarea></td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Emergency Contact Name</td>
      <td class="answer">
        <input type="text" name="emerg_contact_name" size="20" maxlength="100" value="<?=@$fields['emerg_contact_name']?>"/>
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Emergency Contact Phone Number</td>
      <td class="answer">
        <input type="text" name="emerg_contact_phone" size="12" maxlength="15" value="<?=@$fields['emerg_contact_phone']?>"/> Please include your area code
      </td>
    </tr>
    <tr>
      <td class="red">*</td>
      <td>Emergency Contact Country</td>
      <td class="answer">
      <select name="emerg_contact_country"> 
        <option <?php if (@$fields['emerg_contact_country'] == "") echo "selected"; ?> value="">Select Country</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Canada") echo "selected"; ?> value="Canada">Canada</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "United States") echo "selected"; ?> value="United States">United States</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "United Kingdom") echo "selected"; ?> value="United Kingdom">United Kingdom</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Afghanistan") echo "selected"; ?> value="Afghanistan">Afghanistan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Albania") echo "selected"; ?> value="Albania">Albania</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Algeria") echo "selected"; ?> value="Algeria">Algeria</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "American Samoa") echo "selected"; ?> value="American Samoa">American Samoa</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Andorra") echo "selected"; ?> value="Andorra">Andorra</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Angola") echo "selected"; ?> value="Angola">Angola</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Anguilla") echo "selected"; ?> value="Anguilla">Anguilla</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Antarctica") echo "selected"; ?> value="Antarctica">Antarctica</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Antigua and Barbuda") echo "selected"; ?> value="Antigua and Barbuda">Antigua and Barbuda</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Argentina") echo "selected"; ?> value="Argentina">Argentina</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Armenia") echo "selected"; ?> value="Armenia">Armenia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Aruba") echo "selected"; ?> value="Aruba">Aruba</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Australia") echo "selected"; ?> value="Australia">Australia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Austria") echo "selected"; ?> value="Austria">Austria</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Azerbaijan") echo "selected"; ?> value="Azerbaijan">Azerbaijan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bahamas") echo "selected"; ?> value="Bahamas">Bahamas</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bahrain") echo "selected"; ?> value="Bahrain">Bahrain</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bangladesh") echo "selected"; ?> value="Bangladesh">Bangladesh</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Barbados") echo "selected"; ?> value="Barbados">Barbados</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Belarus") echo "selected"; ?> value="Belarus">Belarus</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Belgium") echo "selected"; ?> value="Belgium">Belgium</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Belize") echo "selected"; ?> value="Belize">Belize</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Benin") echo "selected"; ?> value="Benin">Benin</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bermuda") echo "selected"; ?> value="Bermuda">Bermuda</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bhutan") echo "selected"; ?> value="Bhutan">Bhutan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bolivia") echo "selected"; ?> value="Bolivia">Bolivia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bosnia and Herzegovina") echo "selected"; ?> value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Botswana") echo "selected"; ?> value="Botswana">Botswana</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bouvet Island") echo "selected"; ?> value="Bouvet Island">Bouvet Island</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Brazil") echo "selected"; ?> value="Brazil">Brazil</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "British Indian Ocean Territory") echo "selected"; ?> value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Brunei Darussalam") echo "selected"; ?> value="Brunei Darussalam">Brunei Darussalam</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Bulgaria") echo "selected"; ?> value="Bulgaria">Bulgaria</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Burkina Faso") echo "selected"; ?> value="Burkina Faso">Burkina Faso</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Burundi") echo "selected"; ?> value="Burundi">Burundi</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cambodia") echo "selected"; ?> value="Cambodia">Cambodia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cameroon") echo "selected"; ?> value="Cameroon">Cameroon</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cape Verde") echo "selected"; ?> value="Cape Verde">Cape Verde</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cayman Islands") echo "selected"; ?> value="Cayman Islands">Cayman Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Central African Republic") echo "selected"; ?> value="Central African Republic">Central African Republic</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Chad") echo "selected"; ?> value="Chad">Chad</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Chile") echo "selected"; ?> value="Chile">Chile</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "China") echo "selected"; ?> value="China">China</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Christmas Island") echo "selected"; ?> value="Christmas Island">Christmas Island</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cocos (Keeling) Islands") echo "selected"; ?> value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Colombia") echo "selected"; ?> value="Colombia">Colombia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Comoros") echo "selected"; ?> value="Comoros">Comoros</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Congo") echo "selected"; ?> value="Congo">Congo</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Congo, The Democratic Republic of The") echo "selected"; ?> value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cook Islands") echo "selected"; ?> value="Cook Islands">Cook Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Costa Rica") echo "selected"; ?> value="Costa Rica">Costa Rica</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cote D'ivoire") echo "selected"; ?> value="Cote D'ivoire">Cote D'ivoire</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Croatia") echo "selected"; ?> value="Croatia">Croatia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cuba") echo "selected"; ?> value="Cuba">Cuba</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Cyprus") echo "selected"; ?> value="Cyprus">Cyprus</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Czech Republic") echo "selected"; ?> value="Czech Republic">Czech Republic</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Denmark") echo "selected"; ?> value="Denmark">Denmark</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Djibouti") echo "selected"; ?> value="Djibouti">Djibouti</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Dominica") echo "selected"; ?> value="Dominica">Dominica</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Dominican Republic") echo "selected"; ?> value="Dominican Republic">Dominican Republic</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Ecuador") echo "selected"; ?> value="Ecuador">Ecuador</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Egypt") echo "selected"; ?> value="Egypt">Egypt</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "El Salvador") echo "selected"; ?> value="El Salvador">El Salvador</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Equatorial Guinea") echo "selected"; ?> value="Equatorial Guinea">Equatorial Guinea</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Eritrea") echo "selected"; ?> value="Eritrea">Eritrea</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Estonia") echo "selected"; ?> value="Estonia">Estonia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Ethiopia") echo "selected"; ?> value="Ethiopia">Ethiopia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Falkland Islands (Malvinas)") echo "selected"; ?> value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Faroe Islands") echo "selected"; ?> value="Faroe Islands">Faroe Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Fiji") echo "selected"; ?> value="Fiji">Fiji</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Finland") echo "selected"; ?> value="Finland">Finland</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "France") echo "selected"; ?> value="France">France</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "French Guiana") echo "selected"; ?> value="French Guiana">French Guiana</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "French Polynesia") echo "selected"; ?> value="French Polynesia">French Polynesia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "French Southern Territories") echo "selected"; ?> value="French Southern Territories">French Southern Territories</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Gabon") echo "selected"; ?> value="Gabon">Gabon</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Gambia") echo "selected"; ?> value="Gambia">Gambia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Georgia") echo "selected"; ?> value="Georgia">Georgia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Germany") echo "selected"; ?> value="Germany">Germany</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Ghana") echo "selected"; ?> value="Ghana">Ghana</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Gibraltar") echo "selected"; ?> value="Gibraltar">Gibraltar</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Greece") echo "selected"; ?> value="Greece">Greece</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Greenland") echo "selected"; ?> value="Greenland">Greenland</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Grenada") echo "selected"; ?> value="Grenada">Grenada</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Guadeloupe") echo "selected"; ?> value="Guadeloupe">Guadeloupe</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Guam") echo "selected"; ?> value="Guam">Guam</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Guatemala") echo "selected"; ?> value="Guatemala">Guatemala</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Guinea") echo "selected"; ?> value="Guinea">Guinea</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Guinea-bissau") echo "selected"; ?> value="Guinea-bissau">Guinea-bissau</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Guyana") echo "selected"; ?> value="Guyana">Guyana</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Haiti") echo "selected"; ?> value="Haiti">Haiti</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Heard Island and Mcdonald Islands") echo "selected"; ?> value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Holy See (Vatican City State)") echo "selected"; ?> value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Honduras") echo "selected"; ?> value="Honduras">Honduras</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Hong Kong") echo "selected"; ?> value="Hong Kong">Hong Kong</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Hungary") echo "selected"; ?> value="Hungary">Hungary</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Iceland") echo "selected"; ?> value="Iceland">Iceland</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "India") echo "selected"; ?> value="India">India</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Indonesia") echo "selected"; ?> value="Indonesia">Indonesia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Iran, Islamic Republic of") echo "selected"; ?> value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Iraq") echo "selected"; ?> value="Iraq">Iraq</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Ireland") echo "selected"; ?> value="Ireland">Ireland</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Israel") echo "selected"; ?> value="Israel">Israel</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Italy") echo "selected"; ?> value="Italy">Italy</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Jamaica") echo "selected"; ?> value="Jamaica">Jamaica</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Japan") echo "selected"; ?> value="Japan">Japan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Jordan") echo "selected"; ?> value="Jordan">Jordan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Kazakhstan") echo "selected"; ?> value="Kazakhstan">Kazakhstan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Kenya") echo "selected"; ?> value="Kenya">Kenya</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Kiribati") echo "selected"; ?> value="Kiribati">Kiribati</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Korea") echo "selected"; ?> value="Korea">Korea</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Korea, Republic of") echo "selected"; ?> value="Korea, Republic of">Korea, Republic of</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Kuwait") echo "selected"; ?> value="Kuwait">Kuwait</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Kyrgyzstan") echo "selected"; ?> value="Kyrgyzstan">Kyrgyzstan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Lao People's Democratic Republic") echo "selected"; ?> value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Latvia") echo "selected"; ?> value="Latvia">Latvia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Lebanon") echo "selected"; ?> value="Lebanon">Lebanon</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Lesotho") echo "selected"; ?> value="Lesotho">Lesotho</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Liberia") echo "selected"; ?> value="Liberia">Liberia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Libyan Arab Jamahiriya") echo "selected"; ?> value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Liechtenstein") echo "selected"; ?> value="Liechtenstein">Liechtenstein</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Lithuania") echo "selected"; ?> value="Lithuania">Lithuania</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Luxembourg") echo "selected"; ?> value="Luxembourg">Luxembourg</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Macao") echo "selected"; ?> value="Macao">Macao</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Macedonia") echo "selected"; ?> value="Macedonia">Macedonia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Madagascar") echo "selected"; ?> value="Madagascar">Madagascar</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Malawi") echo "selected"; ?> value="Malawi">Malawi</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Malaysia") echo "selected"; ?> value="Malaysia">Malaysia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Maldives") echo "selected"; ?> value="Maldives">Maldives</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Mali") echo "selected"; ?> value="Mali">Mali</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Malta") echo "selected"; ?> value="Malta">Malta</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Marshall Islands") echo "selected"; ?> value="Marshall Islands">Marshall Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Martinique") echo "selected"; ?> value="Martinique">Martinique</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Mauritania") echo "selected"; ?> value="Mauritania">Mauritania</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Mauritius") echo "selected"; ?> value="Mauritius">Mauritius</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Mayotte") echo "selected"; ?> value="Mayotte">Mayotte</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Mexico") echo "selected"; ?> value="Mexico">Mexico</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Micronesia") echo "selected"; ?> value="Micronesia">Micronesia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Moldova") echo "selected"; ?> value="Moldova">Moldova</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Monaco") echo "selected"; ?> value="Monaco">Monaco</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Mongolia") echo "selected"; ?> value="Mongolia">Mongolia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Montserrat") echo "selected"; ?> value="Montserrat">Montserrat</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Morocco") echo "selected"; ?> value="Morocco">Morocco</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Mozambique") echo "selected"; ?> value="Mozambique">Mozambique</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Myanmar") echo "selected"; ?> value="Myanmar">Myanmar</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Namibia") echo "selected"; ?> value="Namibia">Namibia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Naurux") echo "selected"; ?> value="Nauru">Nauru</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Nepal") echo "selected"; ?> value="Nepal">Nepal</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Netherlands") echo "selected"; ?> value="Netherlands">Netherlands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Netherlands Antilles") echo "selected"; ?> value="Netherlands Antilles">Netherlands Antilles</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "New Caledonia") echo "selected"; ?> value="New Caledonia">New Caledonia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "New Zealand") echo "selected"; ?> value="New Zealand">New Zealand</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Nicaragua") echo "selected"; ?> value="Nicaragua">Nicaragua</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Niger") echo "selected"; ?> value="Niger">Niger</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Nigeria") echo "selected"; ?> value="Nigeria">Nigeria</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Niue") echo "selected"; ?> value="Niue">Niue</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Norfolk Island") echo "selected"; ?> value="Norfolk Island">Norfolk Island</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Northern Mariana Islands") echo "selected"; ?> value="Northern Mariana Islands">Northern Mariana Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Norway") echo "selected"; ?> value="Norway">Norway</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Oman") echo "selected"; ?> value="Oman">Oman</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Pakistan") echo "selected"; ?> value="Pakistan">Pakistan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Palau") echo "selected"; ?> value="Palau">Palau</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Palestinian Territory, Occupied") echo "selected"; ?> value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Panama") echo "selected"; ?> value="Panama">Panama</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Papua New Guinea") echo "selected"; ?> value="Papua New Guinea">Papua New Guinea</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Paraguay") echo "selected"; ?> value="Paraguay">Paraguay</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Peru") echo "selected"; ?> value="Peru">Peru</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Philippines") echo "selected"; ?> value="Philippines">Philippines</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Pitcairn") echo "selected"; ?> value="Pitcairn">Pitcairn</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Poland") echo "selected"; ?> value="Poland">Poland</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Portugal") echo "selected"; ?> value="Portugal">Portugal</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Puerto Rico") echo "selected"; ?> value="Puerto Rico">Puerto Rico</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Qatar") echo "selected"; ?> value="Qatar">Qatar</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Reunion") echo "selected"; ?> value="Reunion">Reunion</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Romania") echo "selected"; ?> value="Romania">Romania</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Russian Federation") echo "selected"; ?> value="Russian Federation">Russian Federation</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Rwanda") echo "selected"; ?> value="Rwanda">Rwanda</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Saint Helena") echo "selected"; ?> value="Saint Helena">Saint Helena</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Saint Kitts and Nevis") echo "selected"; ?> value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Saint Lucia") echo "selected"; ?> value="Saint Lucia">Saint Lucia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Saint Pierre and Miquelon") echo "selected"; ?> value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Saint Vincent and The Grenadines") echo "selected"; ?> value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Samoa") echo "selected"; ?> value="Samoa">Samoa</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "San Marino") echo "selected"; ?> value="San Marino">San Marino</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Sao Tome and Principe") echo "selected"; ?> value="Sao Tome and Principe">Sao Tome and Principe</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Saudi Arabia") echo "selected"; ?> value="Saudi Arabia">Saudi Arabia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Senegal") echo "selected"; ?> value="Senegal">Senegal</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Serbia and Montenegro") echo "selected"; ?> value="Serbia and Montenegro">Serbia and Montenegro</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Seychelles") echo "selected"; ?> value="Seychelles">Seychelles</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Sierra Leone") echo "selected"; ?> value="Sierra Leone">Sierra Leone</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Singapore") echo "selected"; ?> value="Singapore">Singapore</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Slovakia") echo "selected"; ?> value="Slovakia">Slovakia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Slovenia") echo "selected"; ?> value="Slovenia">Slovenia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Solomon Islands") echo "selected"; ?> value="Solomon Islands">Solomon Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Somalia") echo "selected"; ?> value="Somalia">Somalia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "South Africa") echo "selected"; ?> value="South Africa">South Africa</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "South Georgia and The South Sandwich Islands") echo "selected"; ?> value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Spain") echo "selected"; ?> value="Spain">Spain</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Sri Lanka") echo "selected"; ?> value="Sri Lanka">Sri Lanka</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Sudan") echo "selected"; ?> value="Sudan">Sudan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Suriname") echo "selected"; ?> value="Suriname">Suriname</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Svalbard and Jan Mayen") echo "selected"; ?> value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Swaziland") echo "selected"; ?> value="Swaziland">Swaziland</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Sweden") echo "selected"; ?> value="Sweden">Sweden</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Switzerland") echo "selected"; ?> value="Switzerland">Switzerland</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Syrian Arab Republic") echo "selected"; ?> value="Syrian Arab Republic">Syrian Arab Republic</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Taiwan, Province of China") echo "selected"; ?> value="Taiwan, Province of China">Taiwan, Province of China</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Tajikistan") echo "selected"; ?> value="Tajikistan">Tajikistan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Tanzania, United Republic of") echo "selected"; ?> value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Thailand") echo "selected"; ?> value="Thailand">Thailand</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Timor-leste") echo "selected"; ?> value="Timor-leste">Timor-leste</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Togo") echo "selected"; ?> value="Togo">Togo</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Tokelau") echo "selected"; ?> value="Tokelau">Tokelau</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Tonga") echo "selected"; ?> value="Tonga">Tonga</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Trinidad and Tobago") echo "selected"; ?> value="Trinidad and Tobago">Trinidad and Tobago</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Tunisia") echo "selected"; ?> value="Tunisia">Tunisia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Turkey") echo "selected"; ?> value="Turkey">Turkey</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Turkmenistan") echo "selected"; ?> value="Turkmenistan">Turkmenistan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Turks and Caicos Islands") echo "selected"; ?> value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Tuvalu") echo "selected"; ?> value="Tuvalu">Tuvalu</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Uganda") echo "selected"; ?> value="Uganda">Uganda</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Ukraine") echo "selected"; ?> value="Ukraine">Ukraine</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "United Arab Emirates") echo "selected"; ?> value="United Arab Emirates">United Arab Emirates</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "United Kingdom") echo "selected"; ?> value="United Kingdom">United Kingdom</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "United States") echo "selected"; ?> value="United States">United States</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "United States Minor Outlying Islands") echo "selected"; ?> value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Uruguay") echo "selected"; ?> value="Uruguay">Uruguay</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Uzbekistan") echo "selected"; ?> value="Uzbekistan">Uzbekistan</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Vanuatu") echo "selected"; ?> value="Vanuatu">Vanuatu</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Venezuela") echo "selected"; ?> value="Venezuela">Venezuela</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Viet Nam") echo "selected"; ?> value="Viet Nam">Viet Nam</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Virgin Islands, British") echo "selected"; ?> value="Virgin Islands, British">Virgin Islands, British</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Virgin Islands, U.S.") echo "selected"; ?> value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Wallis and Futuna") echo "selected"; ?> value="Wallis and Futuna">Wallis and Futuna</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Western Sahara") echo "selected"; ?> value="Western Sahara">Western Sahara</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Yemen") echo "selected"; ?> value="Yemen">Yemen</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Zambia") echo "selected"; ?> value="Zambia">Zambia</option> 
        <option  <?php if (@$fields['emerg_contact_country'] == "Zimbabwe") echo "selected"; ?> value="Zimbabwe">Zimbabwe</option>
      </select>
    
      </td>
    </tr>
    <tr>
      <td width="10" class="red">*</td>
      <td>Emergency Contact Relationship</td>
      <td class="answer">
        <input type="text" name="emerg_contact_relationship" size="20" maxlength="50" value="<?=@$fields['emerg_contact_relationship']?>"/>
      </td>
    </tr>
    </table>
    
    <br />
    
    <table class="error" style="width: 660px">
    <tr>
      <td>
        This is page <b>1</b> of <b>5</b>. You must complete all steps in order for your registration
        to be processed. Please click continue.
      </td>
      <td align="right" width="80">
        <input type="submit" name="continue" value="Continue" />
      </td>  
    </tr>
    </table>

  </form>
  
 
</body>
</html>

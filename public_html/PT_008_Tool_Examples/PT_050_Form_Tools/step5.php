<?php 
require_once("../../tools/formtools/global/api/api.php");
$fields = ft_api_init_form_page();
ft_api_clear_form_sessions();
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

  <p>
    And here's the "thank you" page. Now, try logging into Form Tools. This will 
		let you see how the form submissions look to this client, and what options 
		are available for managing the data.
  </p>

  <hr size="1" />
  <br />
	
  <table cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/trail1.jpg" /></td>
    <td><img src="images/trail2b.jpg" /></td>
    <td><img src="images/trail3b.jpg" /></td>
    <td><img src="images/trail4b.jpg" /></td>
    <td><img src="images/trail5b.jpg" /></td>
  </tr>
  </table>

  <h3>COMPLETE</h3>
  <p>
    Thank you for registering! We look forward to seeing you in Tampa Bay for the final 
    cruise of your life!
  </p>

</body>
</html>

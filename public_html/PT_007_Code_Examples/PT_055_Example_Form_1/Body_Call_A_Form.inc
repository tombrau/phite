<!-- Simple Form Example -->

<?php global $PHITE_vars;?>     <!-- Get the PHITE environment array -->

<center><p><h2>Example Form Call:</h2>
This Script Shows How To Call A Form in PHITE.<p>
Push the <b>Call Form</b> button to see the form<br>

<?php
  if (isset($PHITE_vars['yourtext'])) {
	} else {
		$PHITE_vars['yourtext'] = "TestForm";
	}
  $yourtext=$PHITE_vars['yourtext'];    # variables are passed within the environment array
  if (isset($yourtext))
  {
    print("<h2>You Typed: ".$yourtext."</h2><p>");
  }
?>

<!-- Note the address for 'Action =' in the next line -- this is how you embed the form in the PHITE skin -->
<form method="post" action=<?php print("'".$PHITE_vars['PHITE_callself']."'"); ?>>
      Example Text Box: <input type="text" size=25 name="yourtext">
      <input type="submit" VALUE="Call Form">
</form>
</center>

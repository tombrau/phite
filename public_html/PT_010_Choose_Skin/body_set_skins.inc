<!-- Code to change PHITE skin -->

<?php global $PHITE_vars;?>

<center><p><h2>Choose Skin:</h2>
If cookies are set you can see how easy it is to change the look and feel of the site.<p> 
<form method="post" enctype="multipart/form-data" action=<?php print("'".$PHITE_vars['PHITE_callself']."'"); ?>>
<select name="skin" size="1">

<?php
  $setskin=$PHITE_vars['PHITE_skin']; 
  if (isset($setskin))
  {
    setcookie('PHITE_'.$PHITE_vars['PHITE_sitesig'].'_skin',$setskin);
  }
  $skindir = './'.$PHITE_vars['PHITE_sitesig'].'_MAIN/skins/';
  $d=dir($skindir);
  while($entry=$d->read())
  {
    if (substr($entry,strrpos($entry,'.')+1)=="tpl" && substr($entry,0,1)!='_')
	{
	  $entry = substr($entry,0,strrpos($entry,'.'));
      print('<option>'.$entry.'</option>');
	}
   }
?>

</select>
<input type="submit" VALUE="Set Skin">
</center>

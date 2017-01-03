<!-- Directory listing right block -->

<?php global $PHITE_vars;

$d=dir($PHITE_vars['PHITE_selfdir']);
while ($file=$d->read())
{ 
  if (substr($file,0,1)!='.')print($file."<br>");
}
?>


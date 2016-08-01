<!-- CB.inc file to display all of the code in current directory -->

<?php global $PHITE_vars;

print ("<CENTER><h3>Files in ".$PHITE_vars['PHITE_selfdir']."</h3><TABLE WIDTH='80%' border='1'><tr><td>");
$d=dir($PHITE_vars['PHITE_selfdir']);
while ($file=$d->read())
{ 
  if (strtolower(substr(strrchr($file,'.'),1))=='inc')
  {
    print("<TR><TD><center><b>".$file."</b></center><p>");
	show_source($PHITE_vars['PHITE_selfdir'].'/'.$file);
	print("</TR>");
  }
}
print("</TABLE></center>");

print ("<CENTER><TABLE WIDTH='80%' border='1'><tr><td>");
$d=dir($PHITE_vars['PHITE_selfdir']);
while ($file=$d->read())
{ 
  if (strtolower(substr(strrchr($file,'.'),1))=='txt')
  {
    print("<TR><TD><center><b>".$file."</b></center><p>");
	show_source($PHITE_vars['PHITE_selfdir'].'/'.$file);
	print("</TR>");
  }
}
print("</TABLE></center>");

?>


<CENTER><h1>Environment</h1><TABLE WIDTH="80%" border="1">
<?php global $PHITE_vars;

while ($var=each($PHITE_vars))
{
  print("<TR><TD><font size='1'>".$var['key']."</font></TD><TD><font size='1'>".$var['value']."</font></TD>");
}
print("<TR><TD><font size='1'>Working dir</font></TD><TD><font size='1'>".getcwd()."</font></TD>");
?>
</TABLE></center>


<?php global $PHITE_vars;

$columns=3;			 # Number of columns to display pictures
$thumbs=true;		 # Display as Thumbs?
$th_w=60;			 # Thumb width
$th_h=60;			 # Thumb height

print ("<CENTER><h3>Download Files</h3><TABLE WIDTH='80%' border='0'>");
$n=0;
$d=dir($PHITE_vars['PHITE_selfdir']);
while ($file=$d->read())
{
  $ext=substr(strrchr($file,'.'),1);
  
  if ($ext=='gz' || $ext=='zip' || $ext=='ZIP')
  {
    $n+=1;
	$size=intval(filesize($PHITE_vars['PHITE_selfdir']."/".$file)/1024);
    print("<TR><TD><center><a href='".$PHITE_vars['PHITE_selfdir']."/".$file."'>".$file."</a>&nbsp;(".$size."&nbsp;KB)</TR>");
  }
}
if ($n==0) print("<TR><TD>No Downloadable files/TD>");
print("</TABLE></center>");
?>


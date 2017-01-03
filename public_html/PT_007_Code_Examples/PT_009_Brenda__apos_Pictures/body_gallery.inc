<!-- gallery_body.inc file to display all of the pictures in directory as a gallery -->
<?php global $PHITE_vars;
//PHITE_siteroot
// modified by tombr 2009

$columns=3;			 # Number of columns to display pictures
$thumbs=true;		 # Display as Thumbs?
$th_w=60;			 # Thumb width
$th_h=60;			 # Thumb height

print ("<CENTER><h1>".$PHITE_vars['PHITE_pagename']." Gallery</h1><TABLE WIDTH='80%' border='1'>");
$n=0;
print("<TR>");

//change to the location of your image folder
//$image_dir=$PHITE_vars['PHITE_selfdir'];
$image_dir='./images/gallerys/gallery_1';
$d=dir($image_dir);

while ($file=$d->read())
{
  $ext=substr(strrchr($file,'.'),1);
  
  if ($ext=='jpg' || $ext=='gif' || $ext=='jpeg' || $ext=='bmp' || $ext=='png')
  {
    $n+=1;
	$filnam=substr($file,0,strrpos($file,'.')); # Trim any extension
    print("<TD><center><a href='".$image_dir."/".$file."' target='_blank'><img src='".$image_dir."/".$file."'");
	if ($thumbs) print(" width='60' height='60'");
	print ("></a><br><a href='".$image_dir."/".$file."' target='_blank'>".$filnam."</a></center></TD>");
	if ($n%$columns == 0) print("</TR>");
  }
}
if ($n==0) print("<TD>No Pictures Found</TD>");
print("</TABLE></center>");
?>


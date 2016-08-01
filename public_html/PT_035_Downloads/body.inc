<table border=0 width="550" height="37" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" background=images/skins/4481/2bevelRECTorange.gif" bgcolor="red">
      <span class="style24">Phite Downloads</span>
    </td> 
  </tr>
  <tr>
  <td>

<table WIDTH="100%" border="0" cellspacing="0" cellpadding="2">
<?php
   global $PHITE_vars;

print("<blockquote class='style28'>");
print("Phite Related Downloads"); 
print("");
print(""); 
print("");
print("</blockquote>");
	 
	 $linkfile = 'links.txt'; # Name of links text file to read
	 $linksdir = 'links';	  # Sub-directory containing links file and icons
	 $sep = '|'; 		 	  # Separator character used in links file
	 
	 $wkdir=$PHITE_vars['PHITE_selfdir'].'/'.$linksdir;
	 $contents = file($wkdir.'/'.$linkfile);
	 while (list ($line_num, $line) = each ($contents))
	 {
	     $line=htmlspecialchars ($line);
	     $parts=explode($sep,$line);
		 $cat = $parts[0];

		 if ($cat != $last_cat) {
		 	print("<tr bgcolor='#dbdbdb'><td colspan='3'><b>".$parts[0]."</b></td>  </tr>");
			$last_cat = $parts[0];
		 }
	 	print("<tr><td valign='middle' align='right'>");
	 	print("<a href='".$parts[2]."' target='_blank'><img src='".$wkdir."/".$parts[1].".gif' border='0'></a></td>");
	 	print("<td><a href='http://".$parts[2]."' target='_blank'>".$parts[3]."</a><br><div style='margin-left: 40px;'>".$parts[4]."</div></td></tr>");
     }

?>

</table><br>
  
  </td>
  </tr>  
</table>

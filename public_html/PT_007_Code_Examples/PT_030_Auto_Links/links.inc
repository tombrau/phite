<?php
     global $PHITE_vars;
	 
	 $linkfile = 'links.txt'; # Name of links text file to read
	 $linksdir = 'links';	  # Sub-directory containing links file and icons
	 $sep = '|'; 		 	  # Separator character used in links file
	 
	 $wkdir=$PHITE_vars['PHITE_selfdir'].'/'.$linksdir;
	 $contents = file($wkdir.'/'.$linkfile);
	 while (list ($line_num, $line) = each ($contents))
	 {
	     $line=htmlspecialchars ($line);
	     $parts=explode($sep,$line);
		 print("<tr><td valign='middle' align='right'>");
		 print("<a href='".$parts[1]."' target='_blank'><img src='".$wkdir."/".$parts[0].".gif' border='0'></a></td>");
		 print("<td><a href='".$parts[1]."' target='_blank'>".$parts[2]."</a>: ".$parts[3]."</td></tr>");
     }

?>

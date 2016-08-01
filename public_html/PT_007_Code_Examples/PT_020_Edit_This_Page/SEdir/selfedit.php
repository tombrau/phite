<HTML>
<HEAD>
<TITLE>SelfEdit</TITLE>
</HEAD>
<BODY>
<h3>Edit Block Text</h3>

<?php
# Lock access to the directory containing this script, then remove the following
# lines. I cannot help you lock the directory, and you must know what you are doing
# to make this safe. Sorry. This is only a beta script.
  echo "Please lock access to this script before use,<br>then remove these lines from selfedit.php<br>".
  	   "How you do this depends on your server.<br>On Apache ".
	   "it is usually through .htaccess files.<br>Sorry, I ".
	   "cannot give you help with this.";
  return;
  
# Work if register_globals is off
	 if (isset($HTTP_SERVER_VARS['PHP_SELF'])) $PHP_SELF=$HTTP_SERVER_VARS['PHP_SELF']; 
	 if (isset($HTTP_POST_VARS['noconvnl'])) $noconvnl=true; else $noconvnl=false;
	 if (isset($HTTP_POST_VARS['changed'])) $changed=true; else $changed=false;
	 if (isset($HTTP_POST_VARS['editedtext'])) $editedtext=$HTTP_POST_VARS['editedtext']; else $editedtext="";
	 
     $nicetags="<b><i><u><hr><h1><h2><h3><br><center>";
	 echo "You can use any of the following HTML tags: ".htmlspecialchars($nicetags)."<br>";
	 echo "Remember you will need to refresh the original page to see your changes.<p>";
	 if ($changed)
	 {
	   $editedtext=stripslashes($editedtext);
	   $editedtext=strip_tags($editedtext,$nicetags);
	   if (!$noconvnl)$editedtext=ereg_replace("(\r\n|\n|\r)", "<br />", $editedtext);
	   $fd=fopen('selfedit.txt', 'w+') or die ('Failed to open text file for writing');
	   flock($fd,LOCK_EX);
	   $fout=fwrite($fd, $editedtext);
	   flock($fd,LOCK_UN);
	   fclose($fd);
	 }
	 $fd=fopen('selfedit.txt', 'r') or die ('Failed to open text file for reading');
	 flock($fd,LOCK_SH);
	 $origtext=fread($fd, filesize('selfedit.txt'));
	 flock($fd,LOCK_UN);
	 fclose($fd);
	 if (!$noconvnl)
	 {
	   $origtext = eregi_replace('<br[[:space:]]*/?[[:space:]]*>', "\n", $origtext);
	 }
	 echo "<form method='post' action='".$PHP_SELF."'>";
	 echo "<textarea rows='15' cols='70' name='editedtext' wrap='virtual'>".$origtext."</textarea><p>";
	 echo "Note: New lines in the text box above will be ";
	 echo "converted to the HTML &lt;BR&gt; tag.<BR> If you want to supply the &lt;BR&gt; tags yourself, then ";
	 echo "check the box below to disable this behavior<BR>";
	 echo "<input type='checkbox' name='noconvnl'";
	 if ($noconvnl) echo "checked";
	 echo "> Do not convert new lines to &lt;BR&gt; (you will loose current line formatting)";
	 echo "<input type='hidden' name='changed' value='1'>";
	 echo "<p><input type='submit' value='Update Text'></form>";
?>

</BODY>
</HTML>
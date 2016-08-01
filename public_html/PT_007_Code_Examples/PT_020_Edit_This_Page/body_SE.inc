<center><h3>Editable Page Beta Version</h3></center>
This is an early version of a user-editable page that I hope to include in the
1.0 PHITE package. All of the text below the line can be edited through the web
by any user who has password access to the selfedit.php file
If you don't understand how to lock a directory on your server then please don't use this.
Also, I will not be able to help you -- different webservers work differently. 
<p> To edit the page, click on the small gray italic 'edit' at the bottom
right of this block.<p>
<hr>
<h3>Try it out, but please be polite!</h3>

<?php
/* Script to display editable text file, with link to editor */
/* Make sure you understand security implications before use */
    global  $PHITE_vars;
	$selfeditdir = 'SEdir'; /*you can change this if you want multiple editable blocks in one PHITE page */
	include $PHITE_vars['PHITE_selfdir'].'/'.$selfeditdir.'/selfedit.txt';
	print('<br><div align="right"><a href="'.$PHITE_vars['PHITE_selfdirURL'].'/'.$selfeditdir.'/selfedit.php" target="_blank" title="Edit Text"><font size="1" color="#a0a0a0"><i>edit</i></font></a></div><br>');
?>

<h1>Function PHITE_script()</h1>
<br>
Provides a standard way to call a script from an element or a block. <br>
<br>
The function takes one to four arguments. <br>
<ol>
<li>The first argument is a string giving the name of the script to be called, 
which must be a .inc file in PHITE's Script directory. <br>
</li>
<li>The second argument is optional, but if it exists it is a string giving 
the path (relative to the .inc file that this function is called from) 
for a script data file (including extension).<br>
</li>
<li>The third argument is an optional array that will be extracted to build 
a set of variables (where the variable name is the key and the value is the value).<br>
</li>
<li>The fourth argument is an optional value that defines the separator of the data file.<br>
</li>
</ol>
The script data file may contain variables, that will be set, and/or 
a LIST of records that will be extracted into the array <br>
$PHITE_listdata[][]. <br>
<br>
See the examples to understand the format of the standard script data file. 
The reason for the extensive use of $PHITE_ is to prevent any name clash 
in scripts.<br>
<br>
<b>Note:</b> Do not create YOUR OWN variables in your scripts that start with 
$PHITE_ The script itself can just reference any of the variables by name, 
and/or use the prepared $PHITE_listdata[][] array. <br>
<br>
No global declarations are necessary.<br>

<?php
     $vars=array('teddy'=>'bear');
     PHITE_script('test','data.txt',$vars,'|');
?>

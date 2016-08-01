<br><center><h3>Known Issues with PHITE</h3></center>
<p><b>Spaces in filenames confuse Netscape.</b><br>
Netscape doesn't seem to replace spaces with %20 in GET variables. For now, make
sure that filenames don't have spaces (use _ underscore instead).
<br>This is fixed in 0.92.

<p><b>The MAIN directory cannot have sub-directories.</b><br>
This is a limitation with the current design. If this is an issue for you then
you can decide not to use the _MAIN directory at all, and create a _001_Home directory
instead. Note that acquisition will still pass through the _MAIN directory.<br>
This will be fixed when I fully abstract the navigation model, but it will not be
fixed in version 1.0.

<p><b>Variable passed to each() is not array or object in phite.php on line 285.</b><br>
This is probably due to the non-existence of the POST or GET environment arrays in
your PHP implementation. Change the line in PHITE.php that says:<br>
<i>while ($var = each($HTTP_POST_VARS))</i><br>to:<br>
<i>if (isset($HTTP_POST_VARS)) while ($var = each($HTTP_POST_VARS))</i><br>
and similarly change:<br>
<i>while ($var = each($HTTP_GET_VARS))</i><br>to:<br>
<i>if (isset($HTTP_GET_VARS)) while ($var = each($HTTP_GET_VARS))</i><br>
This is fixed in 0.92.

<p><b>Warning: Undefined variable: bodyname in ...</b><br>
This is fixed in 0.92.



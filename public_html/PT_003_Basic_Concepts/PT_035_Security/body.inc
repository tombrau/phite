<span style="font-weight: bold;">Security</span><br><br> 

PHITE does not itself interpret any arbitrary user input. You should, however, make sure that any code snippets you have sufficiently scrub user input.<br><br>
As with all PHP scripts arbitrary variables can be set through GET. This is not a problem with the current script, and variables must be explicitly unpacked in code snippets. 

<br><br>
Be aware, however, that PHITE can be made to execute any .inc file that is accessible to PHP. You should make sure that there are no potentially damaging .inc files accessible.
It is good practice to drop a blank index.html file in each directory to deter people from getting directory listings.
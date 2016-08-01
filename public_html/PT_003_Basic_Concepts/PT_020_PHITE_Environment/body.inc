<span style="font-weight: bold;">Phite Environment</span><br><br>PHP snippets in PHITE are 'require'd within a function so that there is no chance
of namespace clash. The environment is imported into a PHP snippet by starting off
with:<p>
<b>&lt;?php global $PHITE_vars; ?&gt;</b></p><p>
The $PHITE_vars[] array holds all of the variables you should need to write a script.
GET and POST variables are included in the array using their names as key, so GET
variable 'x' would be accessible as $PHITE_vars['x']. POST variables over-ride GET
variables where there is a name clash.</p><p>
PHITE also provides some important variables of its own. These variables all commence
with 'PHITE_' to avoid name clashes. The PHITE_ variables are:<br>
</p><pre><font size="2">
$PHITE_vars["PHITE_sitename"]     # Name of the current site
$PHITE_vars["PHITE_siteroot"]     # Root URL of the site
$PHITE_vars["PHITE_sitesig"]      # Signature string for the current site
$PHITE_vars["PHITE_homepagename"] # Name of homepage for the current site
$PHITE_vars["PHITE_mainscript"]   # URL for the mainscript
$PHITE_vars["PHITE_callself"]     # URL to call this page
$PHITE_vars["PHITE_fullcallself"] # URL to call this page with GET vars set
$PHITE_vars["PHITE_selfdir"]      # Dir. of this script relative PHITE.php
$PHITE_vars["PHITE_selfdirURL"]   # Dir. of this script as full URL
$PHITE_vars["PHITE_pagename"]     # The name of the current page
$PHITE_vars["PHITE_scriptdir"]    # The standard dir. for scripts (relative)
$PHITE_vars["PHITE_page"]         # Full name of current page
$PHITE_vars["PHITE_subpage"]      # Full name of current subpage
$PHITE_vars["PHITE_skin"]         # Filename of current 'skin' .tpl file
</font></pre><font size="2"></font>
Note that with these variables it should be easy to write script snippets without
any hard-coded URLs or directories.<br>
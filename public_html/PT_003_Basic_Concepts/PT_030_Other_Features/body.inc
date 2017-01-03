<span style="font-weight: bold;">Other Features</span><br><br><b>Redirects:</b> If a page or sub-page directory contains a file that contains a
.inc file whose name is 'redirect.inc' or begins with 'redirect_' then the link name
appears in the navigation block as usual, but the link URL is derived from
the contents of the redirect file. The file can be plain text, HTML or PHP like any
other snippet.<p>
<b>Character Substitution:</b> Characters which are illegal in filenames can be inserted
by including a substitution string beginning with two underscores ('__'). Thus "Benda__apos_File"
becomes "Brenda's File". The substitutions can be set in the 'SETTINGS' section of the
main script. The substitutions included in the distribution are:
</p><pre><font size="2">$namechars['__apo'] = "'";
$namechars['__que'] = "?";
$namechars['__col'] = ":";
$namechars['__com'] = ",";
# 20170103: added '/' character substitution
$namechars['__fsl'] = "/";
</font></pre><font size="2"></font><p>
<b>Multiple Sites:</b> You can have multiple 'sites' served by the same root script.
The site signatures ensure that there is no ambiguity as to what pages belong to what
site. For example, the site with signature 'XY' is seen by simply pointing the browser
at PHITE.php?sitesig=XY.<br>
The standard distribution comes with a single site defined:
</p><pre><font size="2">$sites['PT'] = array('name'=&gt;"PHITE","homepagename"=&gt;'Home',
                     'def_skin'=&gt;'YellowNBlue');
</font></pre><font size="2"></font>

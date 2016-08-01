<span style="font-weight: bold;">Elements</span><br><br>PHITE pages are built up by snippets of content automatically being inserted into the site template.
Snippets come in two basic types, <i>elements</i> and <i>blocks</i>.<p>
<b>Elements</b> are snippets that have a single value or content on the page. These
elements are used in the .tpl template file between braces thus: {PAGENAME}. Whenever
{PAGENAME} is encountered in the .tpl file it is replaced with the contents of
the element PAGENAME for the current page.</p><p>
<b>Built-in Elements</b> included in PHITE are:
</p><ul><li>SITENAME: The name of the current site;
</li><li>PAGENAME: The name of the current page (or sub-page);
</li><li>HOMELINK: The URL to the Home Page;
</li><li>HOMENAME: The name of the Home Page.
</li></ul>You do not need to do anything to use these, they are generated automatically.
Just include the element names in braces in your .tpl file where you need them.<p>
<b>Defined Elements</b> are defined in the 'Settings' section of the script. The
standard distribution of PHITE includes the following defined elements:
</p><pre><font size="2">
  $elements['BODY']   = array('el_name'=&gt;'BODY',   'acq'=&gt;true); 
  $elements['FOOTER'] = array('el_name'=&gt;'FOOTER', 'acq'=&gt;true);
  $elements['META']   = array('el_name'=&gt;'META',   'acq'=&gt;true);
  $elements['DATE']   = array('el_name'=&gt;'DATE',   'acq'=&gt;true);
  $elements['PRINT']  = array('el_name'=&gt;'PRINT_FRIENDLY', 'acq'=&gt;true);
</font></pre><font size="2"></font>
For example, let us take the BODY contents element. The code will look in the current
page/subpage directory for a file called BODY.inc or BODY_any_arbitrary_text.inc. The
contents of the file found will be substituted for the element {BODY} in the .tpl
template file being used. Note that the 'signature' (e.g. 'PRINT') and the entry
in the .tpl file (e.g. {PRINT_FRIENDLY}) may have different names.<br>
The above defined elements should form a good starting point for a site. You can
easily add your own as needed.<p>
<b>Acquisition</b>. The final flag 'acq'=&gt;true (or false) tells PHITE what to do if
the file is not found in the current page or subpage directory. If 'acq' is true, then
it will look to see if it can be found in the containing page or in the {sig}_MAIN directory.
For example, the element 'PRINT' is set by placing a file in the {sig}_MAIN directory and it is
used in the whole site if no other PRINT.inc (or PRINT_somename.inc) files are in any of the
pages or subpages.<br>
</p>
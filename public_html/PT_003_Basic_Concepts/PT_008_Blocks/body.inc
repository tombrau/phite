<span style="font-weight: bold;">Blocks</span><br><br>PHITE pages are built up by snippets of content automatically being inserted into the site template.
Snippets come in two basic types, <i>elements</i> and <i>blocks</i>.<p>
<b>Blocks</b> are snippets that can have multiple values or content on the page. These
elements are used in the .tpl template file within TemplatePower Blocks. See the example
.tpl files for the format of these, or see the
<a href="http://templatepower.codocad.com/" target="_blank">TemplatePower documentation</a>.<br>
Note that there may be zero or more instances of a specific block type on a page.
</p><p>
<b>Built-in Blocks</b> included in PHITE are:
</p><ul><li>LEFT_NAV: The navigation block, with each navigation option having name OPTION_NAME and link content OPTION_LINK;
</li><li>SUB_NAV: The subpage navigation block, with title SUB_NAME and link content SUB_LINK;
</li></ul>See the example .tpl files for how to use these. Note that the exact behavior
of the subpage navigation block is determined by settings in the SETTINGS area of the
main script<p>
<b>Defined BLOCKS</b> are defined in the 'Settings' section of the script. The
standard distribution of PHITE includes the following defined blocks:
</p><pre><font size="2">
$blocks['RB'] = array('bl_name'=&gt;'RIGHT_BOX', 'bl_title'=&gt;'RB_TITLE',
                      'bl_content'=&gt;'RB_CONTENT', 'acq'=&gt;true);
$blocks['LB'] = array('bl_name'=&gt;'LEFT_BOX' , 'bl_title'=&gt;'LB_TITLE',
                      'bl_content'=&gt;'LB_CONTENT', 'acq'=&gt;true);
$blocks['CB'] = array('bl_name'=&gt;'CENTER_BOX' , 'bl_title'=&gt;'CENTER_TITLE',
                      'bl_content'=&gt;'CENTER_CONTENT', 'acq'=&gt;false);
</font></pre><font size="2"></font>
For example, let us take the RB right-block. The code will look in the current
page/subpage directory for files with names like RB_sort_Name_of_this_block.inc. Each
file found will cause an instance of the block RIGHT_BOX to be created with {RB_TITLE}
set to 'Name of this block' and {RB_CONTENT} set to the contents of the file. The
'sort' part of the filename is used to determine the order the blocks appear on the
page.<br>
The above defined blocks should form a good starting point for a site. You can
easily add your own as needed.<p>
<b>Acquisition</b>. The final flag 'acq'=&gt;true (or false) tells PHITE what to do if
no files of the block's type are found in the current page or subpage directory. If 'acq' is true, then
it will look to see if it can be found in the containing page or in the {sig}_MAIN directory.
<br>
</p>
<span style="font-weight: bold;">Basic Concepts</span><br><br>A PHITE site is automatically built from the directory structure and contents
below the directory which holds the PHITE.php script itself.<br>
A key concept is that of the <i>site signature</i>. This is a small string of letters
and numbers which is used to identify the directories which 'belong' to this site.
Consider the following example, where the site signature has been set to 'PT': <br>
<center><img src="http://www.phite.org/images/PHITE_dirs.gif"></center><br>
Note that there could be other directories around, but if they don't start with the
signature they are ignored. In this example we have the 'home' page, which is in
the special directory PT_MAIN (every site must have a {sig}_MAIN directory). This
directory holds the contents for the homepage. It also holds the special directory
'skins' which holds at least one .tpl template file. The 'scripts' directory is a place
to put code snippets that are used in multiple pages, but may be empty.<br>
The site also has two 'pages' that are automaticaly added to the navigation. They
are in directories with names of the form PT_sort_Name_for_the_page. Here PT is the
signature for the current site, sort is an arbitrary string used to sort the pages
and Name_for_the_page is the title that will be used for this page. Thus in this
example we have two pages titled 'Page 1' and 'Another Page', in that order.<br>
Note that underscores are converted to spaces.<br>Subdirectories work in the same
way, creating automatic navigation to subpages. The current version of PHITE does
not recognize directories any deeper.
<br><center><h3>Frequently Asked Questions</h3></center>
<p><b>How do I upgrade from 0.9 to 0.92</b><br>
Simply replace your PHITE.php with the one from the 0.92 release bundle. You will
of course have to change any of the variable setting to match your original set up. Also,
copy the ERROR_badpage directory and contents from PT_MAIN in the 0.92 distribution
to your {sig}_MAIN directory

<p><b>Can PHITE only do 'box'-like sites?</b><br>
No, PHITE can run any site that has common, recurring elements on the pages, of
any type. It is true that the examples I have given are of the standard 'left-',
'center-', 'right-' box types, but if you look at the definition arrays at the
beginning of the script you should be able to see how to make other, more general
page elements

<p><b>How do I modify an existing PHP script for PHITE?</b><br>
Read the description of the PHITE environment carefully first. The most common
mistake is to forget that you cannot just access POST- or GET- variables. You
have to explicitly declare the $PHITE_vars array as global first, then you have to
load the passed variables into their places by $myvar=$PHITE_vars['myvar'];<br>
If a script needs to call itself (as is common with FORM submissions) use $PHITE_vars['PHITE_callself']
as the target.

<p><b>Will you modify the script to do X?</b><br>
I might add modifications to the next version of the script if they are likely to
be useful to everyone. If you modify the script yourself let me know and I will
look at adding your changes. Note however that I do not want to add lots of 'special'
features -- I am interested in keeping the core script as generic as possible. Before
you modify the script make sure you understand the definition arrays at the top. These
are very powerful and flexible, and you may well be able to achieve your changes without 
touching the core script.<br>
Note that I am most interested in getting a stable, useful, general script. I plan to
use most of my time on website content, not the script that drives it.

<p><b>Do I have to use a full URL for the siteroot?</b><br>
Probably not. Try using a relative path (I have it set to "." on this site). I recommend
using a full URL as I haven't tested on all web servers, so I don't know how they
treat relative paths. They seem to work fine on Apache though.

<p><b>PHITE is secure right?</b><br>
This is the first public release of PHITE, so it hasn't been heavily
tested for security yet. If you look at the documentation on this site I make some comments
about security. You do need to make sure that if you ask for any user input
then it is suitably scrubbed (users can't put malicious HTML/scripts in
there). Also, people can fake GET variables (this is often an issue in PHP).
I am not aware of any issues with faked GET/POST variables, but one thing
you need to be aware of is that any '.inc' file that PHP can see can be made
to run. Again, you just need to make sure that there are no potentially
damaging '.inc' files hanging about.

<p><b>How does PrintFriendly work?</b><br>
The 'PRINT_FRIENDLY' feature is a bit of a hack I must admit. What it does is insert a link back to the current page, but with the 'special' skin '_PrintFriendly.tpl'. If you look in your sig_MAIN directory you will see the piece of code PRINT.inc that calculates the link name.<br>
The template just needs to have the following in it: {PRINT_FRIENDLY}, and a link should appear where you place it.<br>
This does show, however, how features can be added without changing the core script.

<p><b>What other skins do you have?</b><br>
OK, HTML is not my strong suit, which is one of the reasons I wrote PHITE. If you have
any cool skins (original, don't lift from other sites) then do contribute them.

<p><b>Can I use .CSS file?</b><br>
Absolutely. And .js as well. Whatever client-side technology you want to use can be
added to the .tpl files.

<p><b>Will you list my PHITE-based site?</b><br>
Yes, as long as it is not a hate-based site. If it has adult content or similar
warn me so that I can warn people who may rather not click-through.
<br>
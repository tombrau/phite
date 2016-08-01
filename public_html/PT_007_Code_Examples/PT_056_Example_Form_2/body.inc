<!-- Form code created by Web Form Designer 1.2.1 -->
<script type="text/javascript">
function Download_form_CF(){
 var errormessage = new String();
var vF = document.forms["Download_form"];
if(Download_form_WithoutContent(vF["name"].value)){errormessage += "\n\nPlease fill in the \"name\" edit field";}
if(Download_form_NotAlphanumeric(vF["name"].value)){errormessage += "\n\n \"name\" can only contain alphanumeric characters";}
if(Download_form_WithoutContent(vF["email"].value)){errormessage += "\n\nPlease fill in the \"email\" edit field";}
if(Download_form_NotEmail(vF["email"].value)){errormessage += "\n\nThe entry for \"email\" does not appear to be a valid email address";}

if (errormessage.length > 2){
    alert("There are errors or ommissions in the form" + errormessage + "\n");
    return false;
    }
return true;
} // end of Download_form_CF()

function Download_form_WithoutContent(ss){
  if (ss.length>0){return false;}
return true;
}

function Download_form_WithoutCheck(ss){
  if(ss.checked){return false;}
return true;
}

function Download_form_NotEmail(ss){
  var splitted = ss.match("^(.+)@(.+)$");
  if (ss.length == 0){return false;}
  if(splitted == null) return true;
  if(splitted[1] != null){
    var regexp_user=/^\"?[\w-_\.]*\"?$/;
    if(splitted[1].match(regexp_user) == null) return true;
  }
  if(splitted[2] != null){
    var regexp_domain=/^[\w-\.]*\.[A-Za-z]{2,4}$/;
    if(splitted[2].match(regexp_domain) == null){
	 var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
      if(splitted[2].match(regexp_ip) == null) return true;
    }
  return false;
  }
return true;
}

function Download_form_NotAlphanumeric(ss){
  var charpos = ss.search("[^ A-Za-z0-9']");
  if(ss.length > 0 &&  charpos >= 0){return true;}
return false;
}

</script>
<noscript><strong>Your browser either does not support JavaScript or it is turned off.<br>Without Javascript enabled, this form will not function correctly</strong></noscript>

<div id="WFDForm" style="position:relative;left:0px;top:0px;width:372px;height:262px;color:#FF0000;border-width:3;border-style:solid;">
<form name="Download_form" action="http://www.phite.org.au/tools/mail/formtoemail.php" method="POST" enctype="application/x-www-form-urlencoded" onsubmit="return Download_form_CF();">
<input type="submit" onClick="return confirm('Are you sure you want to submit this form?');" name="submitBtn" value="Send" tabindex="1" style="position:absolute;z-index:1;left:230px;top:200px;width:82px;height:24px;font-size:8pt;font-family:Verdana;font-weight:normal;font-style:normal;color:#000000;background-color:#C0C0C0;">
<input type="reset" name="resetBtn" value="Clear form" tabindex="2" style="position:absolute;z-index:2;left:70px;top:200px;width:82px;height:24px;font-size:8pt;font-family:Verdana;font-weight:normal;font-style:normal;color:#000000;background-color:#C0C0C0;">
<div id="WFDObj3" style="position:absolute;z-index:3;left:10px;top:12px;width:89px;height:20px;font-size:10pt;font-family:Verdana;font-weight:normal;font-style:normal;text-align:left;color:#000000;">
*Your name:</div>
<input type="text" name="name" value="" size="40" maxlength="35" tabindex="3" style="position:absolute;z-index:4;left:110px;top:10px;width:242px;height:22px;font-size:10pt;font-family:Verdana;font-weight:normal;font-style:normal;color:#000000;background-color:#FFFFFF;">

<div id="WFDObj5" style="position:absolute;z-index:5;left:10px;top:42px;width:150px;height:20px;font-size:10pt;font-family:Verdana;font-weight:normal;font-style:normal;text-align:left;color:#000000;">
*Your e-mail address:</div>
<input type="text" name="email" value="" size="40" maxlength="40" tabindex="4" style="position:absolute;z-index:6;left:165px;top:40px;width:187px;height:22px;font-size:10pt;font-family:Verdana;font-weight:normal;font-style:normal;color:#000000;background-color:#FFFFFF;">

<div id="WFDObj7" style="position:absolute;z-index:7;left:5px;top:230px;width:137px;height:16px;font-size:7pt;font-family:Verdana;font-weight:normal;font-style:normal;text-align:left;color:#FF0000;">
* indicates a required field</div>
<div id="WFDObj8" style="position:absolute;z-index:8;left:19px;top:67px;width:61px;height:20px;font-size:10pt;font-family:Verdana;font-weight:normal;font-style:normal;text-align:left;color:#000000;">
Message</div>
<textarea  name="message" rows="6" cols="25" wrap="virtual" tabindex="5" style="position:absolute;z-index:9;left:20px;top:87px;width:332px;height:108px;font-size:10pt;font-family:Verdana;font-weight:normal;font-style:normal;color:#000000;background-color:#FFFFFF;"></textarea>
<div id="WFD" style="position:absolute;z-index:10;left:285px;top:243px;font-size:7pt;font-family:Arial;text-align:left;">
<A HREF="http://www.webformdesigner.com">WebFormDesigner</A></div>
</form>
</div>
<!-- End of WebFormDesigner form code -->
